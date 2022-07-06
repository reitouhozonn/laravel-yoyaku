<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $events = Event::orderBy('start_date', 'asc')->paginate(10);
        $events = DB::table('events')
            ->orderBy('start_date', 'asc')
            ->paginate(5);

        return Inertia::render('Manager/Events/index', [
            'events' => $events
        ]);

        // return Inertia::render('Manager/Events/index', [
        //     'events' => Event::all()
        //         // ->orderBy('start_date', 'asc')
        //         // ->paginate(10)
        //         ->map(function ($event) {
        //             return [
        //                 'id' => $event->id,
        //                 'name' => $event->name,
        //                 'start_date' => $event->start_date,
        //                 'end_date' => $event->end_date,
        //                 'max_people' => $event->max_people,
        //                 'is_visible' => $event->is_visible,
        //             ];
        //         }),
        // ]);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
