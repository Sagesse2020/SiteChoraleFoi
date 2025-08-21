<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Login;
use Illuminate\Support\Facades\DB;


class StatistiqueController extends Controller
{
    public function index()
    {
        $totalVisits = Visit::count();
        $uniqueVisitors = Visit::distinct('ip_address')->count('ip_address');
        $visitsByPage = Visit::select('page_visited', DB::raw('count(*) as total'))
            ->groupBy('page_visited')
            ->orderByDesc('total')
            ->get();

        $logins = Login::with('user')
            ->orderByDesc('logged_in_at')
            ->take(20)
            ->get();

        return view('statistiques', compact('totalVisits', 'uniqueVisitors', 'visitsByPage', 'logins'));
    }
}
