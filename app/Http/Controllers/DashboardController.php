<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalMembers = Member::count();
        $goodStandingMembers = Member::where('status', 'good_standing')->count();

        $averageAge = Member::all()->avg(function ($member) {
            return Carbon::parse($member->date_of_birth)->age;
        });
        
        $memberTypes = Member::select('member_type', DB::raw('count(*) as count'))
            ->groupBy('member_type')
            ->pluck('count', 'member_type');

        return view('dashboard', [
            'totalMembers' => $totalMembers,
            'goodStandingMembers' => $goodStandingMembers,
            'averageAge' => round($averageAge),
            'memberTypes' => $memberTypes,
        ]);
    }
}
