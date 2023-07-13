<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Transave\ScolaCvManagement\Http\Models\Qualification;


class EducationalQualificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EducationalQualification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => config('scolacv.auth_model')::factory(),
            'institution' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(8),
            'qualification_id' => Qualification::factory(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addYears(4),
            'country_id' => Country::factory(),
        ];
    }
}
