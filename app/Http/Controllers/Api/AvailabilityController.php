<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\TimeZoneHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    private function formatDate($date)
    {
        // $timezone = TimeZoneHelper::getUserTimezoneFromCountry(auth()->user()->country);
        return Carbon::parse($date)->toDateString();
    }

    private function formatTime($time)
    {
        return Carbon::parse($time)->format('H:i:s');
    }

    private function isDateValid($date)
    {
        $currentDate = date('Y-m-d');
        return $date >= $currentDate;
    }
    private function isValidTime($time)
    {
        $currentTime = Carbon::now();
        $givenTime = Carbon::parse($time);
        $difference = $givenTime->diffInSeconds($currentTime);
        if ($difference < 0)
            return false;
        else
            return true;
    }

    private function isTimeWithinSchedule($schedule, $dayOfWeek, $startTime, $endTime)
    {
        if ($schedule)
            foreach ($schedule as $slot) {
                if ($slot->day === $dayOfWeek && !$slot->isFrozen) {
                    $slotStartTime = $slot->startTime;
                    $slotEndTime = $slot->endTime;
                    if (!empty($slotStartTime) && !empty($slotEndTime)) {
                        if ($startTime >= $slotStartTime && $endTime <= $slotEndTime) {
                            return true;
                        }
                    }
                }
            }

        return false;
    }

    private function isOrderAvailable($vendorId, $date, $startTime, $endTime)
    {
        $existingOrder = Order::where('vendor_id', $vendorId)
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('starttime', '>=', $startTime)
                        ->where('starttime', '<', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('endtime', '>', $startTime)
                        ->where('endtime', '<=', $endTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('starttime', '<=', $startTime)
                        ->where('endtime', '>=', $endTime);
                });
            })
            ->get();

        foreach ($existingOrder as $key => $order) {
            if ($order != null) {
                if ($order->status != 2) {
                    return false;
                }
            }
        }
        return true;


    }

    public function checkAvailability(Request $request)
    {
        $startTime = $this->formatTime($request->starttime);
        $endTime = $this->formatTime($request->endtime);

        $date = $this->formatDate($request->date);

        if (!$this->isDateValid($date)) {
            return Api::setError('Date must be today or in the future');
        }
        if (!$this->isValidTime($startTime)) {
            return Api::setError('Time must be greater than or equal to current time');
        }

        $service = Service::where('vendor_id', $request->vendor_id)->first();

        if ($service == null) {
            return Api::setError('Service not found');
        }

        $schedule = json_decode($service->schedual);

        $dayOfWeek = date('l', strtotime($date));

        if (!$this->isTimeWithinSchedule($schedule, $dayOfWeek, $startTime, $endTime)) {
            return Api::setError('Timings are not within Schedule, please try other times');
        }

        $vendorId = $request->vendor_id;

        $notExistingOrder = $this->isOrderAvailable($vendorId, $date, $startTime, $endTime);


        if($notExistingOrder)
        return Api::setResponse('available', true);
        else
        return Api::setError('Timings are booked , please try other times');
    }
}
