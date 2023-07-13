<?php


namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\State;

class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'capital' => $this->faker->city,
            'country_id' => Country::factory(),
        ];
    }
}