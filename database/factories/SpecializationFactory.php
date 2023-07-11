<?php

namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Transave\ScolaCvManagement\Http\Models\User;

class SpecializationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Specialization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => config('scolacv.auth_model')::factory(),
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];
    }
}
