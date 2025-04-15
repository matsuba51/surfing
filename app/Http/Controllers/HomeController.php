<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('home', compact('layout'));
    }
}
