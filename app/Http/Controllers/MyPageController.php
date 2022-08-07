<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use App\Services\MyPageService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyPageController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $events = $user->events;
        $fromTodayEvents = MyPageService::reservedEvent($events, 'fromToday');
        $pastEvents = MyPageService::reservedEvent($events, 'past');


        return Inertia::render('MyPage/index', [
            'fromTodayEvents' => $fromTodayEvents,
            'pastEvents' => $pastEvents,
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $reservation = Reservation::where('user_id', '=', Auth::id())
            ->where('event_id', '=', $id)
            ->whereNull('canceled_date')
            ->first();

        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;
        $today = Carbon::today()->format('Y年m月d日');

        return Inertia::render('MyPage/show', [
            'event' => $event,
            'reservation' => $reservation,
            'eventDate' => $eventDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'today' => $today,
        ]);
    }

    public function cancel(Request $request, String $id)
    {
        $reservation = Reservation::where('user_id', '=', Auth::id())
            ->where('event_id', '=', $id)
            ->whereNull('canceled_date')
            ->first();

        if ($request->number_of_people === $reservation->number_of_people) {
            $reservation->canceled_date = Carbon::now()->format('Y-m-d H-i-s');
            $reservation->save();
        }

        session()->flash('flash.banner', 'キャンセルしました。');
        session()->flash('flash.bannerStyle', 'success');

        return  redirect()->route('mypage.index');
    }
}
