<?php

namespace App\Models;

use App\Helpers\TimeZoneHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'servicetype',
        'price',
        'starttime',
        'endtime',
        'status',
        'vendor_id',
        'date',
        'duration',
        'scheduletype',
        'meetingtype',

        'latitude', 'longitude'
    ];

    public function setSchedualAttribute($value)
    {
        $schedule = json_decode($value, true);

        foreach ($schedule as &$daySchedule) {
            $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);
            $daySchedule['startTime'] = $this->convertToUTC($daySchedule['day'], $daySchedule['startTime'], $timezone );
            $daySchedule['endTime'] = $this->convertToUTC($daySchedule['day'], $daySchedule['endTime'], $timezone);
        }

        $this->attributes['schedual'] = json_encode($schedule);
    }

    private function convertToUTC($day, $time, $timezone)
    {
        return Carbon::parse($day . ' ' . $time, $timezone)->utc()->format('H:i');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function setStartTimeAttribute($value)
    {
        $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);

        $this->attributes['starttime'] = Carbon::parse($value, $timezone)->setTimezone('UTC');

    }

    public function setEndTimeAttribute($value)
    {
        $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);

        $this->attributes['endtime'] = Carbon::parse($value, $timezone)->setTimezone('UTC');

    }

    public function getStartTimeAttribute($value)
    {
        $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);

        return Carbon::parse($value, 'UTC')->setTimezone($timezone);
    }

    public function getEndTimeAttribute($value)
    {
        $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);

        return Carbon::parse($value, 'UTC')->setTimezone($timezone);
    }

    public function getCreatedAtAttribute($value)
    {
        $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);
        return Carbon::parse($value, 'UTC')->setTimezone($timezone);
    }
}
