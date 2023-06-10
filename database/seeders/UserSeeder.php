<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        User::create([
            'username' => 'ali',
            'email' => 'ali@mail.com',
            'phone' => 'fjkfvfkvdfkmv',
            'password' => 123456,
            'api_token' => Str::random(60)
        ]);

        $vendor =  Vendor::create([
            'name' => $faker->name,
            'username' => 'ali2000',
            'password' => 1234556,
            'DOB' => $faker->date,
            'passport' => 'data:image/png;base64,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',
            'number' => $faker->phoneNumber,
            'status' => true,
            'online' => $faker->boolean,
            'api_token' => Str::random(60),
            'language' => json_encode($faker->randomElements(['English', 'Spanish', 'French'], 2)),
            'rating' => $faker->randomFloat(1, 0, 5),
        ]);

        Service::create([
            'vendor_id' => $vendor->id,
            'schedual' => '[{"day":"Monday","startTime":"16:34","endTime":"16:35","isFrozen":false},{"day":"Tuesday","startTime":"18:35","endTime":"16:35","isFrozen":false},{"day":"Wednesday","startTime":"18:37","endTime":"16:37","isFrozen":false},{"day":"Thursday","startTime":"13:40","endTime":"16:42","isFrozen":false},{"day":"Friday","startTime":"","endTime":"","isFrozen":false},{"day":"Saturday","startTime":"","endTime":"","isFrozen":false},{"day":"Sunday","startTime":"","endTime":"","isFrozen":false}]',
            'urgent' => '[{"day":"25","price":"25","minpage":"1","maxpage":"25"}]',
            'unurgent' => '[{"day":"25","price":"25","minpage":"1","maxpage":"25"}]',
            'inperson' => '10',
            'audiovideo' => '10',
            'urgentprice'=>'10',
            'unurgentprice'=>'10',
            'onlineaudiovideo'=>'10',
            'longitude'=>'29.054052',
            'latitude'=>'46.048842',
            'radius'=> '1000'
        ]);
    }
}
