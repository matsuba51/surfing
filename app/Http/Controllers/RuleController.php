<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Jenssegers\Agent\Agent;

class RuleController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $reviews = Review::all();
        
        return view('rules.index', compact('reviews', 'layout'));
    }
}
