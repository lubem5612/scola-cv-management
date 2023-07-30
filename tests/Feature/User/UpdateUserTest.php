<?php


namespace Transave\ScolaCvManagement\Tests\Feature\User;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Http\Models\Lg;
use Transave\ScolaCvManagement\Http\Models\Qualification;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateUserTest extends TestCase
{
    private $faker, $user, $request;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        $this->testData();
        Sanctum::actingAs($this->user);
    }

    /** @test */
    function can_update_user_successfully()
    {
        $response = $this->json('POST', "/cv/users/{$this->user->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
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
            'department_id' => Department::factory()->create()->id,
            'residential_address'=> $this->faker->sentence(20),
            'permanent_address'=> $this->faker->sentence(20),
            'marital_status'=> $this->faker->randomElement(['single','divorced','widowed','married']),
            'dob'=> $this->faker->date(),
            'no_of_children'=> $this->faker->randomDigit(),
            'gender'=> $this->faker->randomElement(['male','female','other']),
            'phone'=> $this->faker->phoneNumber,
            'picture' => UploadedFile::fake()->image('pic.jpg'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }
}