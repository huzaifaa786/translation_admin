<?php

namespace App\Models;

use App\Helpers\TimeZoneHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 'schedual', 'urgent', 'unurgent', 'inperson',
         'audiovideo', 'urgentprice', 'unurgentprice','onlineaudiovideo','latitude','longitude','radius',
         'isdocument','isInperson','isAudioVideo'
    ];
    protected $casts = [
        'isInperson' => 'boolean',
        'isdocument'=>'boolean',
        'isAudioVideo'=>'boolean'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getSchedualAttribute($value)
    {
        $schedule = json_decode($value, true);

        $timezone = TimeZoneHelper::getUserTimezoneFromCountry($this->vendor()->first()->country);
        foreach ($schedule as &$daySchedule) {
            $daySchedule['startTime'] = $this->convertToLocal($daySchedule['day'], $daySchedule['startTime'], $timezone);
            $daySchedule['endTime'] = $this->convertToLocal($daySchedule['day'], $daySchedule['endTime'], $timezone);
        }

        return json_encode($schedule);
    }

    private function convertToLocal($day, $time, $timezone)
    {
        return Carbon::parse($day . ' ' . $time, 'UTC')->setTimezone($timezone)->format('H:i');
    }

    public function setSchedualAttribute($value)
    {
        $schedule = json_decode($value, true);

        $timezone = TimeZoneHelper::getUserTimezoneFromCountry($this->vendor()->first()->country);
        foreach ($schedule as &$daySchedule) {
            $daySchedule['startTime'] = $this->convertToUTC($daySchedule['day'], $daySchedule['startTime'], $timezone);
            $daySchedule['endTime'] = $this->convertToUTC($daySchedule['day'], $daySchedule['endTime'], $timezone);
        }

        $this->attributes['schedual'] = json_encode($schedule);
    }

    private function convertToUTC($day, $time, $timezone)
    {
        return Carbon::parse($day . ' ' . $time, $timezone)->setTimezone('UTC')->format('H:i');
    }
}
