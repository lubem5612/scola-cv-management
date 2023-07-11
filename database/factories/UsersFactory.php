<?php
namespace Transave\ScolaCvManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Http\Models\Schools;
use Transave\ScolaCvManagement\Http\Models\User;


class UsersFactory extends Factory
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
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->name,
            'middleName'=> $this->faker->name,
            'school_id' => Schools::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_verified' => $this->faker->randomElement([0, 1]),
            'department_id' => Department::factory(),
            'faculty_id' => Faculty::factory(),
            'state_of_origin' => $this->faker->sentence(20),
            'lga'=> $this->faker->sentence(20),
            'state_of_resident'=> $this->faker->sentence(20),
            'residential_address'=> $this->faker->sentence(20),
            'permanent_address'=> $this->faker->sentence(20),
            'marital_status'=> $this->faker->word,
            'dob'=> $this->faker->date(),
            'no_of_children'=> $this->faker->randomDigit(),
            'gender'=> $this->faker->word,
            'phone'=> $this->faker->phoneNumber,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'user_type' => $this->faker->randomElement(config('scolacv.user_type')),
        ];
    }

}


