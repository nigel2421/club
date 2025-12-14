<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemographicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genderDistribution = Member::select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->pluck('count', 'gender');
        
        $memberTypes = Member::select('member_type', DB::raw('count(*) as count'))
            ->groupBy('member_type')
            ->pluck('count', 'member_type');

        return view('demographics', [
            'genderDistribution' => $genderDistribution,
            'memberTypes' => $memberTypes,
        ]);
    }
}
