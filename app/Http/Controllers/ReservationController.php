<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Services\EventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function dashboard()
    {
        $eventTime = \App\Constants\EventConst::EVENT_TIME;


        $currentWeek = [];
        for ($i = 0; $i < 7; $i++) {
            $day = CarbonImmutable::today()->addDays($i)->format('m月d日');
            $checkDate = CarbonImmutable::today()->addDays($i)->format('Y-m-d');
            $dayOfWeek = CarbonImmutable::today()->addDays($i)->dayName;

            array_push($currentWeek, [
                'day' => $day,
                'checkDate' => $checkDate,
                'dayOfWeek' => $dayOfWeek,
            ]);
        }
        $currentDate = Carbon::today();
        $endDate = Carbon::parse($currentDate)->addDays(7);

        $events = EventService::getWeekEvents(
            $currentDate,
            $endDate->format('Y-m-d')
        );

        return Inertia::render('Dashboard', [
            'currentWeek' => $currentWeek,
            'eventTime' => $eventTime,
            'events' => $events,
        ]);
    }

    public function detail($id)
    {
        $event = Event::findOrFail($id);
        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;

        $reservedPeople = DB::table('reservations')
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->whereNull('canceled_date')
            ->groupBy('event_id')
            ->having('event_id', $event->id)
            ->first();
        if (!is_null($reservedPeople)) {
            $reservablePeople = $event->max_people - $reservedPeople->number_of_people;
        } else {
            $reservablePeople = $event->max_people;
        }
        // dd($reservablePeople);

        return Inertia::render('Eventdetail', [
            'event' => $event,
            'eventDate' => $eventDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'reservablePeople' => $reservablePeople,
        ]);
    }

    public function reserve(Request $request)
    {
        $event = Event::findOrFail($request->id);

        $reservedPeople = DB::table('reservations')
            ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
            ->whereNull('canceled_date')
            ->groupBy('event_id')
            ->having('event_id', $event->id)
            ->first();

        if (
            is_null($reservedPeople)
            || $event->max_people >= $reservedPeople->number_of_people + $request->reserved_people
        ) {
            Reservation::create([
                'user_id' => Auth::id(),
                'event_id' => $request->id,
                'number_of_people' =>  $request->reserved_people,
            ]);
            session()->flash('flash.banner', 'success');
        } else {
            session()->flash('flash.banner', 'この人数は予約できません。');
            session()->flash('flash.bannerStyle', 'danger');
        }
        return redirect()->route('dashboard');
    }
}
