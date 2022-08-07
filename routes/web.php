<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TopCalendarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [TopCalendarController::class, 'top'])->name('calendar');


Route::prefix('manager')
    ->middleware('can:manager')
    ->group(function () {
        Route::get('events/past', [EventController::class, 'past'])->name('events.past');
        Route::resource('events', EventController::class)->except('destroy');
    });


Route::middleware('can:user')
    ->group(function () {
        Route::get('/dashboard', [ReservationController::class, 'dashboard'])->name('dashboard');

        Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');
        Route::get('/mypage/{id}', [MyPageController::class, 'show'])->name('mypage.show');
        Route::post('/mypage/{id}', [MyPageController::class, 'cancel'])->name('mypage.cancel');

        Route::get('/events/{id}', [ReservationController::class, 'detail'])->name('events.detail');
        Route::post('/events/{id}', [ReservationController::class, 'reserve'])->name('events.reserve');
    });
