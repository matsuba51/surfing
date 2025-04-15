<?php

namespace App\Http\Controllers;

use App\Models\Shop; 
use App\Models\Review;
use Jenssegers\Agent\Agent;

class SurfShopController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $shops = Shop::paginate(9);
        
        return view('surfshops.index', compact('shops', 'layout'));
    }

    public function show($id)
    {   
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $shop = Shop::findOrFail($id);
        $shopReviews = $shop->reviews()->latest()->get(); 

        return view('surfshops.show', compact('shop', 'shopReviews','layout'));
    }
}

