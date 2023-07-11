<?php

namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'user_id' => config('scolacv.auth_model')::factory(),
            'responsibilities' => $this->faker->sentence,
            'companyName' => $this->faker->company,
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
            'created_at'=>$this->faker->dateTime(),
        ];
    }
}
