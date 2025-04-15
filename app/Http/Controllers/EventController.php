<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    public function index()
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $events = Event::orderBy('date', 'asc')->get();

        return view('events.index', compact('events', 'layout'));
    }

    public function show($id)
    {
        $isMobile = (new Agent())->isMobile();
        $layout = $isMobile ? 'layouts.mobile' : 'layouts.pc';

        $event = Event::findOrFail($id);
        return view('events.show', compact('event', 'layout'));
    }
}
