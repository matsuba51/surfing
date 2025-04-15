<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurfSpot;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class SpotController extends Controller
{
    public function index()
    {
        $layout = (new Agent())->isMobile() ? 'layouts.mobile' : 'layouts.pc';
        $spots = SurfSpot::paginate(5); 
        return view('admin.spots.index', compact('spots', 'layout'));
    }

    public function show($id)
    {
        $layout = (new Agent())->isMobile() ? 'layouts.mobile' : 'layouts.pc';
        $spot = SurfSpot::findOrFail($id);
        return view('admin.spots.show', compact('spot', 'layout'));
    }

    public function create()
    {
        $layout = (new Agent())->isMobile() ? 'layouts.mobile' : 'layouts.pc';
        return view('admin.spots.create', compact('layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SurfSpot::create($request->all());

        return redirect()->route('admin.spots.index')
            ->with('success', 'サーフスポットが追加されました。');
    }

    public function edit(SurfSpot $spot)
    {
        $layout = (new Agent())->isMobile() ? 'layouts.mobile' : 'layouts.pc';
        return view('admin.spots.edit', compact('spot', 'layout'));
    }

    public function update(Request $request, SurfSpot $spot)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $spot->update($request->all());

        return redirect()->route('admin.spots.edit', ['spot' => $spot->id])
            ->with('success', 'サーフスポットが更新されました。');
    }

    public function destroy(SurfSpot $spot)
    {
        $spot->delete();

        return redirect()->route('admin.spots.index')
            ->with('success', 'サーフスポットが削除されました。');
    }
}
