<?php
namespace Transave\ScolaCvManagement\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Schools;

class SchoolsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schools::class;

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
