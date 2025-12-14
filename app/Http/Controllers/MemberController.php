<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('subscriptions');

        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $query->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm)
                  ->orWhere('member_number', 'like', $searchTerm);
        }

        $members = $query->paginate(15);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone_number' => 'nullable|string',
            'doj' => 'nullable|date',
            'profession' => 'nullable|string',
            'race' => 'nullable|string',
            'minimum_spent' => 'nullable|numeric',
            'contact_details' => 'required|string',
            'status' => 'required|string',
            'member_type' => 'required|string',
            'date_of_birth' => 'required|date',
            'subscriptions' => 'nullable|array',
            'subscriptions.*' => 'integer|min:1900',
        ]);

        $validated['member_number'] = 'MEM-' . uniqid();

        $member = Member::create($validated);

        if ($request->has('subscriptions')) {
            foreach ($request->subscriptions as $year) {
                $member->subscriptions()->create(['year' => $year]);
            }
        }

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        $member->load('subscriptions');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phone_number' => 'nullable|string',
            'doj' => 'nullable|date',
            'profession' => 'nullable|string',
            'race' => 'nullable|string',
            'minimum_spent' => 'nullable|numeric',
            'contact_details' => 'required|string',
            'status' => 'required|string',
            'member_type' => 'required|string',
            'date_of_birth' => 'required|date',
            'subscriptions' => 'nullable|array',
            'subscriptions.*' => 'integer|min:1900',
        ]);

        $member->update($validated);

        $member->subscriptions()->delete();

        if ($request->has('subscriptions')) {
            foreach ($request->subscriptions as $year) {
                $member->subscriptions()->create(['year' => $year]);
            }
        }

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
