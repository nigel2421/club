<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Average Age
        $averageAge = Member::whereNotNull('date_of_birth')->get()->avg(function ($member) {
            return Carbon::parse($member->date_of_birth)->age;
        });
        $averageAge = round($averageAge);


        // Race Data
        $raceData = Member::select('race', DB::raw('count(*) as count'))
            ->groupBy('race')
            ->pluck('count', 'race')
            ->all();

        // Profession Data
        $professionData = Member::select('profession', DB::raw('count(*) as count'))
            ->groupBy('profession')
            ->pluck('count', 'profession')
            ->all();

        dd($raceData, $professionData);

        return view('demographics.index', [
            'genderData' => $genderData,
            'memberTypeData' => $memberTypeData,
            'statusData' => $statusData,
            'averageAge' => $averageAge,
            'raceData' => $raceData,
            'professionData' => $professionData,
        ]);
    }
}
