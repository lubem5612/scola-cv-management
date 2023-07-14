<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Referee;

class RefereeFactory extends Factory
{

    protected $model = Referee::class;

    public function definition()
    {
        return [
            'cv_id' => CV::factory(),
            'name' => $this->faker->word,
            'address' => $this->faker->sentence,
            'place_of_work' => $this->faker->sentence,
            'contact' => $this->faker->phoneNumber,
            'relationship' => $this->faker->word
        ];
    }
}
