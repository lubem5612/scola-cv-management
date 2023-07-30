<?php
namespace Transave\ScolaCvManagement\Tests\Feature\Specialization;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Specialization;

use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateSpecializationTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        Specialization::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_publication()
    {
        $specialization = Specialization::query()->first();
        $response = $this->json('PATCH', "/cv/specializations/update/{$specialization->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'cv_id' => CV::factory()->create()->id,
            'name' => $this->faker->name,
            'description' => $this->faker->sentence
        ];
    }
}