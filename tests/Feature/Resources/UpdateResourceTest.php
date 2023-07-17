<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Resources;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Department;
use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Http\Models\Qualification;
use Transave\ScolaCvManagement\Http\Models\State;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateResourceTest extends TestCase
{
    private $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Faculty::factory()->count(10)->create();
        Department::factory()->count(10)->create();
        Qualification::factory()->count(10)->create();
        Country::factory()->count(10)->create();
        State::factory()->count(10)->create();
        Achievement::factory()->count(10)->create();
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_update_faculty_successfully()
    {
        $request = [
            'name' => $this->faker->name,
        ];
        $faculty = Faculty::query()->inRandomOrder()->first();
        $response = $this->json('PATCH', "/cv/faculties/$faculty->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_update_department_successfully()
    {
        $request = [
            'name' => $this->faker->name,
            'faculty_id' => Faculty::factory()->create()->id,
        ];
        $department = Department::query()->inRandomOrder()->first();
        $response = $this->json('PATCH', "/cv/departments/$department->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_update_qualification_successfully()
    {
        $request = ['name' => $this->faker->name];
        $qualification = Qualification::query()->inRandomOrder()->first();
        $response = $this->json('PUT', "/cv/qualifications/$qualification->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_update_country_successfully()
    {
        $request = [
            'name' => $this->faker->country,
            'code' => $this->faker->countryISOAlpha3
        ];
        $country = Country::query()->inRandomOrder()->first();
        $response = $this->json('POST', "/cv/countries/$country->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_update_state_successfully()
    {
        $request = [
            'name' => $this->faker->name,
            'capital' => $this->faker->name,
            'country_id' => Country::factory()->create()->id,
        ];
        $state = State::query()->first();
        $response = $this->json('PATCH', "/cv/states/$state->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    /** @test */
    function can_update_achievement_successfully()
    {
        $request = [
            'title' => $this->faker->name,
            'description' => $this->faker->sentence(20),
            'date_achieved' => $this->faker->date,
            'cv_id' => CV::factory()->create()->id,
        ];
        $achievement = Achievement::query()->first();
        $response = $this->json('PUT', "/cv/achievements/$achievement->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}