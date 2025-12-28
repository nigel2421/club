<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Imports\MembersImport;
use App\Exports\MembersExport;
use Maatwebsite\Excel\Facades\Excel;

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

        $limit = $request->input('limit', 10);

        $members = $query->paginate($limit)->appends(request()->query());

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
            'gender' => 'required|string',
            'minimum_spent' => 'nullable|numeric',
            'contact_details' => 'required|string',
            'status' => 'required|string',
            'member_type' => 'required|string',
            'date_of_birth' => 'required|date',
            'age' => 'nullable|numeric',
            'subscriptions' => 'nullable|array',
            'subscriptions.*.year' => 'required|integer|min:1900',
            'subscriptions.*.revenue' => 'nullable|numeric',
        ]);

        $validated['member_number'] = 'MEM-' . uniqid();

        $member = Member::create($validated);

        if ($request->has('subscriptions')) {
            foreach ($request->subscriptions as $subscription) {
                $member->subscriptions()->create($subscription);
            }
        }

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        $member->load('subscriptions');
        return view('members.show', compact('member'));
    }

    public function details(Member $member)
    {
        $member->load('subscriptions');
        $subscriptions_by_year = [];
        for ($year = 2020; $year <= 2025; $year++) {
            $subscription = $member->subscriptions->firstWhere('year', $year);
            $subscriptions_by_year[$year] = $subscription ? number_format($subscription->revenue, 2) : 'N/A';
        }

        return response()->json([
            'name' => $member->name,
            'member_number' => $member->member_number,
            'email' => $member->email,
            'phone_number' => $member->phone_number,
            'member_type' => $member->member_type,
            'date_of_birth' => $member->date_of_birth,
            'age' => $member->age,
            'doj' => $member->doj,
            'profession' => $member->profession,
            'race' => $member->race,
            'gender' => $member->gender,
            'minimum_spent' => $member->minimum_spent,
            'subscriptions_by_year' => $subscriptions_by_year,
        ]);
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
            'gender' => 'required|string',
            'minimum_spent' => 'nullable|numeric',
            'contact_details' => 'required|string',
            'status' => 'required|string',
            'member_type' => 'required|string',
            'date_of_birth' => 'required|date',
            'age' => 'nullable|numeric',
            'subscriptions' => 'nullable|array',
            'subscriptions.*.year' => 'required|integer|min:1900',
            'subscriptions.*.revenue' => 'nullable|numeric',
        ]);

        $member->update($validated);

        $member->subscriptions()->delete();

        if ($request->has('subscriptions')) {
            foreach ($request->subscriptions as $subscription) {
                if(!empty($subscription['revenue'])){
                    $member->subscriptions()->create($subscription);
                }
            }
        }

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        $ids = json_decode($request->input('ids'), true);

        if (is_array($ids)) {
            Member::whereIn('id', $ids)->delete();
            return redirect()->route('members.index')->with('success', 'Selected members have been deleted.');
        } else {
            return redirect()->route('members.index')->with('error', 'Invalid request for mass deletion.');
        }
    }

    public function showUploadForm()
    {
        return view('members.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        $import = new MembersImport;
        Excel::import($import, $request->file('file'));

        if ($import->failures()->isNotEmpty()) {
            $errors = [];
            foreach ($import->failures() as $failure) {
                $errorMessages = implode(', ', $failure->errors());
                $errors[] = "Row {$failure->row()}: {$errorMessages}";
            }
            $errorMessage = "Import completed with some errors. Please check the following rows:<br>" . implode('<br>', $errors);
            
            return redirect()->route('members.index')
                ->with('success', 'Import process completed. Some rows were not imported.')
                ->with('error', $errorMessage);
        }

        return redirect()->route('members.index')->with('success', 'All members imported successfully.');
    }

    public function downloadSample()
    {
        return response()->download(base_path('sample_members.csv'));
    }

    public function export()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }
}
