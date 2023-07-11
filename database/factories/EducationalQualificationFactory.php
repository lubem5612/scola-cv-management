<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Transave\ScolaCvManagement\Http\Models\User;
use Transave\ScolaCvManagement\Http\Models\Department;


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
                'department_id' => Department::factory(),
                'qualification_id' => EducationalQualification::factory(),
                'institutionName' => $this->faker->word,
                'courseStudy' => $this->faker->word,
                'startDate' => $this->faker->date(),
                'endDate' => $this->faker->date(),
                'country' => $this->faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ];
    }
}
