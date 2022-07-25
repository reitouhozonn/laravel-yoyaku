<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'information',
        'start_date',
        'end_date',
        'max_people',
        'is_visible'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected function eventDate(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('Y年m月d日'),
        );
    }

    protected function startTime(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('H時i分'),
        );
    }

    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->end_date)->format('H時i分'),
        );
    }

    protected function editEventDate(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('Y-m-d'),
        );
    }
    protected function editStartTime(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('H:i'),
        );
    }

    protected function editEndTime(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->end_date)->format('H:i'),
        );
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reservations')
            ->withPivot('id', 'number_of_people', 'canceled_date');
    }
}
