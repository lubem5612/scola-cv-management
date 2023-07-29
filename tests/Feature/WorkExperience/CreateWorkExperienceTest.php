<?php

namespace Transave\ScolaCvManagement\Tests\Feature\WorkExperience;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateWorkExperienceTest extends TestCase
{

    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }


    /** @test */
    function can_create_workExperience_successfully()
    {
        $request = [
            'cv_id' => CV::factory()->create()->id,
            'responsibilities' => $this->faker->sentence,
            'position'=> $this->faker->name,
            'company' => $this->faker->company,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
        ];
        $response = $this->json('POST', "/cv/work_experiences/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}