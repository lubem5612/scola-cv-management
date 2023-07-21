<?php

namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Transave\ScolaCvManagement\Http\Models\User;

class WorkExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkExperience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'cv_id' => CV::factory(),
            'responsibilities' => $this->faker->sentence,
            'company' => $this->faker->company,
            'position'=> $this->faker->name,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date()
        ];
    }
}
