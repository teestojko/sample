<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Time;
// use App\Models\Author;

class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => $this->faker->numberBetween(1, 3),
            // 'clock_in' => date('H:i:s'), // 現在の時刻のみを表示
            // 'clock_out' => date('H:i:s'),
            // 'break_in' => date('H:i:s'),
            // 'break_out' => date('H:i:s'),
            'user_id' => $this->faker->numberBetween(1,3),
            'clock_in' => Carbon::now(),
            'clock_out' => Carbon::now(),
            'break_in' => Carbon::now(),
            'break_out' => Carbon::now(),
        ];
    }
}
