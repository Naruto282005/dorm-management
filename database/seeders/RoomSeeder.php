<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['room_number' => '101', 'floor' => 1, 'capacity' => 4, 'occupied_beds' => 0, 'monthly_rate' => 2500, 'status' => 'available'],
            ['room_number' => '102', 'floor' => 1, 'capacity' => 4, 'occupied_beds' => 0, 'monthly_rate' => 2500, 'status' => 'available'],
            ['room_number' => '201', 'floor' => 2, 'capacity' => 6, 'occupied_beds' => 0, 'monthly_rate' => 3000, 'status' => 'available'],
        ];

        foreach ($rooms as $room) {
            Room::updateOrCreate(['room_number' => $room['room_number']], $room);
        }
    }
}
