<?php

namespace App\Repositories\Events;

use App\Interfaces\Events\EventInterface;
use App\Models\Event;
use Illuminate\Http\Request;

class EventRepository implements EventInterface
{
    public function index()
    {
        $events = Event::all();

        return view('dashboard.index', compact('events'));
    }

    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start
        ]);

        return response()->json(['status' => 'success', 'id' => $event->id]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id',
            'start' => 'required|date',
        ]);

        $event = Event::find($request->id);
        $event->start = $request->start;
        $event->save();

        return response()->json(['status' => 'success', 'message' => 'تم تحديث الحدث']);
    }
}