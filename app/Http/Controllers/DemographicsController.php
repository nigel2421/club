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
        // Gender Data
        $genderData = Member::select('gender', DB::raw('count(*) as count'))
            ->groupBy('gender')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->gender ?? 'Unspecified' => $item->count];
            })
            ->all();

        // Member Type Data
        $memberTypeData = Member::select('member_type', DB::raw('count(*) as count'))
            ->groupBy('member_type')
            ->pluck('count', 'member_type')
            ->all();

        // Status Data
        $statusData = Member::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->all();


        return view('demographics.index', [
            'genderData' => $genderData,
            'memberTypeData' => $memberTypeData,
            'statusData' => $statusData,
        ]);
    }
}
