<?php

namespace App\Http\Controllers;

use App\Constants\EventConst;
use Illuminate\Support\Facades\Facade;
use Carbon\CarbonImmutable;
use App\Services\EventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class TopCalendarController extends Controller
{
    public function top()
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

        return Inertia::render('calendar', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'currentWeek' => $currentWeek,
            'eventTime' => $eventTime,
            'events' => $events,
        ]);
    }
}
