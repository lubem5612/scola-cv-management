<?php
namespace Transave\ScolaCvManagement\Tests\Feature\Schools;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateSchoolTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        School::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_school()
    {
        $school = School::query()->first();
        $response = $this->json('PATCH', "/cv/schools/update/{$school->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'name' => $this->faker->company,
        ];
    }
}