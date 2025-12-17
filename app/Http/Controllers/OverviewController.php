<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OverviewController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'active')->count();
        $inactiveMembers = Member::where('status', 'inactive')->count();
        $recentMembers = Member::latest()->take(5)->get();

        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $memberSignups = Member::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as signups'))
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartData = [
            'labels' => $memberSignups->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('M d');
            }),
            'data' => $memberSignups->pluck('signups'),
        ];


        return view('overview.index', compact(
            'totalMembers',
            'activeMembers',
            'inactiveMembers',
            'recentMembers',
            'chartData'
        ));
    }
}
