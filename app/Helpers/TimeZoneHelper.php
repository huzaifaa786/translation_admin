<?php

namespace App\Helpers;

class TimeZoneHelper
{
    public static function getUserTimezoneFromCountry($country)
    {
        $timezoneMapping = [
            'USA' => 'America/New_York',
            'India' => 'Asia/Kolkata',
            'Japan' => 'Asia/Tokyo',
            'United Kingdom' => 'Europe/London',
            'Germany' => 'Europe/Berlin',
            'France' => 'Europe/Paris',
            'Australia' => 'Australia/Sydney',
            'Canada' => 'America/Toronto',
            'China' => 'Asia/Shanghai',
            'Brazil' => 'America/Sao_Paulo',
            'Russia' => 'Europe/Moscow',
            'Mexico' => 'America/Mexico_City',
            'South Korea' => 'Asia/Seoul',
            'Italy' => 'Europe/Rome',
            'South Africa' => 'Africa/Johannesburg',
            'Spain' => 'Europe/Madrid',
            'Netherlands' => 'Europe/Amsterdam',
            'Turkey' => 'Europe/Istanbul',
            'Switzerland' => 'Europe/Zurich',
            'Argentina' => 'America/Argentina/Buenos_Aires',
            'Indonesia' => 'Asia/Jakarta',
            'Saudi Arabia' => 'Asia/Riyadh',
            'Egypt' => 'Africa/Cairo',
            'Thailand' => 'Asia/Bangkok',
            'Nigeria' => 'Africa/Lagos',
            'Pakistan' => 'Asia/Karachi',
            'Malaysia' => 'Asia/Kuala_Lumpur',
            'Philippines' => 'Asia/Manila',
            'Vietnam' => 'Asia/Ho_Chi_Minh',
            'Bangladesh' => 'Asia/Dhaka',
            'Poland' => 'Europe/Warsaw',
            'Ukraine' => 'Europe/Kiev',
            'Sweden' => 'Europe/Stockholm',
            'Norway' => 'Europe/Oslo',
            'Greece' => 'Europe/Athens',
            'Portugal' => 'Europe/Lisbon',
            'Israel' => 'Asia/Jerusalem',
            'Singapore' => 'Asia/Singapore',
            'Hong Kong' => 'Asia/Hong_Kong',
            'New Zealand' => 'Pacific/Auckland',
            'Chile' => 'America/Santiago',
            'Colombia' => 'America/Bogota',
            'Peru' => 'America/Lima',
            'Venezuela' => 'America/Caracas',
            'United Arab Emirates' => 'Asia/Dubai',
            'Kazakhstan' => 'Asia/Almaty',
            'Belgium' => 'Europe/Brussels',
            'Czech Republic' => 'Europe/Prague',
            'Hungary' => 'Europe/Budapest',
            'Romania' => 'Europe/Bucharest',
            'Austria' => 'Europe/Vienna',
            'Denmark' => 'Europe/Copenhagen',
            'Finland' => 'Europe/Helsinki',
            'Ireland' => 'Europe/Dublin',
            'Croatia' => 'Europe/Zagreb',
            'Slovakia' => 'Europe/Bratislava',
            'Bulgaria' => 'Europe/Sofia',
            'Serbia' => 'Europe/Belgrade',
            'Slovenia' => 'Europe/Ljubljana',
            'Lithuania' => 'Europe/Vilnius',
            'Latvia' => 'Europe/Riga',
            'Estonia' => 'Europe/Tallinn',
            'Luxembourg' => 'Europe/Luxembourg',
            'Iceland' => 'Atlantic/Reykjavik',
            'Belarus' => 'Europe/Minsk',
            'Bosnia and Herzegovina' => 'Europe/Sarajevo',
            'Macedonia' => 'Europe/Skopje',
            'Montenegro' => 'Europe/Podgorica',
            'Malta' => 'Europe/Malta',
            'Cyprus' => 'Asia/Nicosia'
        ];
        return $timezoneMapping[$country] ?? 'Asia/Dubai';
    }
}
