<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Publication;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreatePublicationTest extends TestCase
{

    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }


    /** @test */
    function can_create_publication_successfully()
    {
        $request = [
            'description' => $this->faker->sentence,
            'short_description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'cv_id' => CV::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/publications/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}