<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\User;
use App\Services\EventService;
use Carbon\Carbon;
use Database\Seeders\EventSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        $today = carbon::today();

        $reservedPeople = DB::table('reservations')
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->groupBy('event_id');


        $events = DB::table('events')
            ->leftJoinSub($reservedPeople, 'reservedPeople', function ($join) {
                $join->on('events.id', '=', 'reservedPeople.event_id');
            })
            ->whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->paginate(5);
        // ->get();
        // dd($events);

        return Inertia::render('Manager/Events/index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Manager/Events/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $check = EventService::checkEventDuplication(
            $request['event_date'],
            $request['start_time'],
            $request['end_time']
        );

        if ($check) {
            session()->flash('flash.banner', 'この時間は、すでに他の予約が存在します。');
            session()->flash('flash.bannerStyle', 'danger');

            return Redirect::route('events.create');
        }

        $startDate = EventService::joinDateAndTime(
            $request['event_date'],
            $request['start_time']
        );

        $endDate = EventService::joinDateAndTime(
            $request['event_date'],
            $request['end_time']
        );

        Event::create([
            'name' => $request['event_name'],
            'information' => $request['information'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'max_people' => $request['max_people'],
            'is_visible' => $request['is_visible'],
        ]);

        session()->flash('flash.banner', '登録しました。');
        // session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = Event::findOrFail($event->id);

        $users = $event->users;

        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;
        $today = Carbon::today()->format('Y年m月d日');

        // dd($today);

        return Inertia::render('Manager/Events/show', [
            'event' => $event,
            'eventDate' => $eventDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'today' => $today,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $event = Event::findOrFail($event->id);

        $eventDate = $event->editEventDate;
        $startTime = $event->editStartTime;
        $endTime = $event->editEndTime;

        return Inertia::render('Manager/Events/edit', [
            'event' => $event,
            'eventDate' => $eventDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ]);
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
        $check = EventService::countEventDuplication(
            $request['event_date'],
            $request['start_time'],
            $request['end_time']
        );

        if ($check > 1) {
            $event = Event::findOrFail($event->id);

            session()->flash('flash.banner', 'この時間は、すでに他の予約が存在します。');
            session()->flash('flash.bannerStyle', 'danger');

            return Redirect::route(
                'events.edit',
                [
                    'event' => $event,
                ]
            );
        }

        $startDate = EventService::joinDateAndTime(
            $request['event_date'],
            $request['start_time']
        );

        $endDate = EventService::joinDateAndTime(
            $request['event_date'],
            $request['end_time']
        );

        $event = Event::findOrFail($event->id);
        $event->name = $request['event_name'];
        $event->information = $request['information'];
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->max_people = $request['max_people'];
        $event->is_visible = $request['is_visible'];
        $event->save();

        session()->flash('flash.banner', '登録しました。');
        // session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('events.index');
    }

    public function past()
    {
        $today = Carbon::today();

        $reservedPeople = DB::table('reservations')
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->groupBy('event_id');

        $events = DB::table('events')
            ->leftJoinSub($reservedPeople, 'reservedPeople', function ($join) {
                $join->on('events.id', '=', 'reservedPeople.event_id');
            })
            ->whereDate('start_date', '<', $today)
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return Inertia::render('Manager/Events/past', [
            'events' => $events,
        ]);
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
