<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Specialization;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\Specialization\CreateSpecialization;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateSpecializationTest extends TestCase
{

    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }


    /** @test */
    function can_create_Specialization_successfully()
    {
        $request = [
            'cv_id' => CV::factory()->create()->id,
            'name' => $this->faker->name,
            'description' => $this->faker->sentence
        ];
        $response = $this->json('POST', "/cv/specializations/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

}