<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Publication;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreatePublicationTest extends TestCase
{
    private $request, $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    /** @test */
    function can_create_credential_successfully()
    {
        $request = [
            'description' => $this->faker->sentence,
            'short_description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'cv_id' => Publication::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/publications", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}