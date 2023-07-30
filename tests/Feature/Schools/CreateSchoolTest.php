<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Schools;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateSchoolTest extends TestCase
{

    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }


    /** @test */
    function can_create_school_successfully()
    {
        $request = [
            'name' => $this->faker->company,
        ];
        $response = $this->json('POST', "/cv/schools/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}