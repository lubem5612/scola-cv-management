<?php
namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\School;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
