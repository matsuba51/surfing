<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class AdminController extends Controller
{
    public function dashboard()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('admin.dashboard', compact('layout')); 
    }
}
