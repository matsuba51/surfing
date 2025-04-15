<?php

namespace App\Http\Controllers;

use App\Models\SurfSpot;
use Jenssegers\Agent\Agent;

class SurfSpotController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $spots = SurfSpot::paginate(9); 
        return view('surfspots.index', compact('spots', 'layout')); 
    }

    public function show($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $surfspot = SurfSpot::findOrFail($id); 
        $reviews = $surfspot->reviews()->latest()->get(); 

        return view('surfspots.show', compact('surfspot', 'reviews', 'layout')); 
    }
}
