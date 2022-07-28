<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class TopCalendarController extends Controller
{
    public function top()
    {
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

        return Inertia::render('calendar', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'currentWeek' => $currentWeek,
        ]);
    }
}
