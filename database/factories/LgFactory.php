<?php


namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Lg;
use Transave\ScolaCvManagement\Http\Models\State;

class LgFactory extends Factory
{
    protected $model = Lg::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'state_id' => State::factory(),
        ];
    }
}