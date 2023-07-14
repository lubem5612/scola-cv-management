<?php

namespace Transave\Scolacvmanagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\Scolacvmanagement\Http\Models\Achievement;
use Transave\ScolaCvManagement\Http\Models\CV;

class AchievementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Achievement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cv_id' => CV::factory(),
            'title' => $this->faker->word,
            'date_achieved' => $this->faker->dateTime,
            'description' => $this->faker->sentence,
        ];
    }
}
