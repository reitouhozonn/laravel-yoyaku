<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
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



        return Inertia::render('Eventdetail', [
            'event' => $event,
            'eventDate' => $eventDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ]);
    }
}
