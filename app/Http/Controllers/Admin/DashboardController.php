<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class DashboardController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $visitStats = $this->getVisitStats();

        return view('admin.dashboard', compact('layout', 'visitStats'));
    }

    public function visitStats()
    {
        return response()->json($this->getVisitStats());
    }

    private function getVisitStats()
    {
        return DB::table('visits')
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }
}
