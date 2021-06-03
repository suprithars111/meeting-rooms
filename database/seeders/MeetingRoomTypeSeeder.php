<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeetingRoomType;

class MeetingRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeetingRoomType::factory()
            ->count(5)
            ->create();
    }
}
