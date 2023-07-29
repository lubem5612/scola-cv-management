<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Auth;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Transave\ScolaCvManagement\Actions\Auth\UpdateAccount;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Http\Models\Lg;
use Transave\ScolaCvManagement\Http\Models\Qualification;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateUserAccountTest extends TestCase
{
    private $user, $request, $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = config('scolacv.auth_model')::factory()->create();
    }

    /** @test */
    public function can_update_user_account()
    {
        $this->testData();
        $response = (new UpdateAccount($this->request))->execute();
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'user_id' => $this->user->id,
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'user_type' => $this->faker->randomElement(config('scolacv.user_type')),
            'qualification_id' => Qualification::factory()->create()->id,
            'country_of_origin_id' => Country::factory()->create()->id,
            'country_of_residence_id' => Country::factory()->create()->id,
            'lg_of_residence_id' => Lg::factory()->create()->id,
            'lg_of_origin_id' =>Lg::factory()->create()->id,
            'school_id' => School::factory()->create()->id,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_verified' => $this->faker->randomElement([0, 1]),
            'department_id' => Department::factory()->create()->id,
            'residential_address'=> $this->faker->sentence(20),
            'permanent_address'=> $this->faker->sentence(20),
            'marital_status'=> $this->faker->word,
            'dob'=> $this->faker->date(),
            'no_of_children'=> $this->faker->randomDigit(),
            'gender'=> $this->faker->word,
            'phone'=> $this->faker->phoneNumber,
            'picture' => UploadedFile::fake()->image('pic.jpg'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}