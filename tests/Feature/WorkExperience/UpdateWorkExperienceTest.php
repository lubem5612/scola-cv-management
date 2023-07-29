<?php
namespace Transave\ScolaCvManagement\Tests\Feature\WorkExperience;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;

use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateWorkExperienceTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        WorkExperience::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_workExperience()
    {
        $workExperience = WorkExperience::query()->first();
        $response = $this->json('PATCH', "/cv/work_experiences/update/{$workExperience->id}", $this->request);
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
            'responsibilities' => $this->faker->sentence,
            'position'=> $this->faker->name,
            'company' => $this->faker->company,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
    }
}