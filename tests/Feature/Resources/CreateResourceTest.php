<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Resources;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateResourceTest extends TestCase
{
    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_create_faculty_successfully()
    {
        $request = ['name' => $this->faker->name];
        $response = $this->json('POST', "/cv/faculties", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_create_department_successfully()
    {
        $request = [
            'name' => $this->faker->name,
            'faculty_id' => Faculty::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/departments", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_create_qualification_successfully()
    {
        $request = ['name' => $this->faker->name];
        $response = $this->json('POST', "/cv/qualifications", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_create_country_successfully()
    {
        $request = [
            'name' => $this->faker->country,
            'code' => $this->faker->countryISOAlpha3
        ];
        $response = $this->json('POST', "/cv/countries", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_create_state_successfully()
    {
        $request = [
            'name' => $this->faker->name,
            'capital' => $this->faker->name,
            'country_id' => Country::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/states", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_create_achievement_successfully()
    {
        $request = [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence(20),
            'date_achieved' => $this->faker->date,
            'cv_id' => CV::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/achievements", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

}