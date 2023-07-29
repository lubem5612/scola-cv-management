<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Training;



class TrainingFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'institution' => $this->faker->company,
            'certificate' => $this->faker->words,
            'description'=> $this->faker->sentence,
            'cv_id' => CV::factory(),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'country_id' => Country::factory(),
        ];
    }

}



