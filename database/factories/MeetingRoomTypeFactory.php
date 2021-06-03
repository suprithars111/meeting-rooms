<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MeetingRoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingRoomTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeetingRoomType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
