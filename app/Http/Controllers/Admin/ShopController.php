<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ShopController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $shops = Shop::paginate(5); 

        return view('admin.shops.index', compact('shops', 'layout'));  
    }

    public function create()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('admin.shops.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:255', 
            'email' => 'nullable|email|max:255',  
        ]);

        Shop::create($validated);  

        return redirect()->route('admin.shops.index')->with('success', 'サーフショップが追加されました。'); 
    }

    public function show(Shop $shop)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('admin.shops.show', compact('shop', 'layout'));
    }

    public function edit(Shop $shop)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        return view('admin.shops.edit', compact('shop', 'layout'));
    }

    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $shop->update($validated);  

        return redirect()->route('admin.shops.edit', ['shop' => $shop->id])
            ->with([
                'layout' => 'success',
                'success' => 'サーフショップが更新されました。'
            ]); 
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();  

        return redirect()->route('admin.shops.index')->with('success', 'サーフショップが削除されました。');  
    }
}
