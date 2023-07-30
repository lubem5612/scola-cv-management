<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Referees;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateRefereeTest extends TestCase
{
    private $request, $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    /** @test */
    function can_create_referee_successfully()
    {
        $request = [
            'cv_id' => CV::factory()->create()->id,
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'place_of_work' => $this->faker->country,
            'contact' => $this->faker->phoneNumber,
            'relationship' => $this->faker->word
        ];
        $response = $this->json('POST', "/cv/referees/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }


}