<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Time;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Time::factory()->count(3)->create();
    }
}
