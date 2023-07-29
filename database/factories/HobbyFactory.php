<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Hobby;

class HobbyFactory extends Factory
{

    protected $model = Hobby::class;

    public function definition()
    {
        return [
            'cv_id' => CV::factory(),
            'name' => $this->faker->word,
            'priority' => $this->faker->words,
        ];
    }
}