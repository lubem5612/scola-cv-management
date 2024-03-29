<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Http\Models\Lg;
use Transave\ScolaCvManagement\Http\Models\Qualification;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Http\Models\User;


class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'user_type' => $this->faker->randomElement(config('scolacv.user_type')),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'qualification_id' => Qualification::factory(),
            'country_of_origin_id' => Country::factory(),
            'country_of_residence_id' => Country::factory(),
            'lg_of_residence_id' => Lg::factory(),
            'lg_of_origin_id' =>Lg::factory(),
            'school_id' => School::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_verified' => $this->faker->randomElement([0, 1]),
            'department_id' => Department::factory(),
            'residential_address'=> $this->faker->sentence(20),
            'permanent_address'=> $this->faker->sentence(20),
            'marital_status'=> $this->faker->word,
            'dob'=> $this->faker->date(),
            'no_of_children'=> $this->faker->randomDigit(),
            'gender'=> $this->faker->word,
            'phone'=> $this->faker->phoneNumber,
            'picture' => $this->faker->image,
            "token" => Str::random(10),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }

}


