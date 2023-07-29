<?php
namespace Transave\ScolaCvManagement\Tests\Feature\Publication;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Publication;

use Transave\ScolaCvManagement\Tests\TestCase;

class UpdatePublicationTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        Publication::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_publication()
    {
        $publication = Publication::query()->first();
        $response = $this->json('POST', "/cv/publications/{$publication->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'description' => $this->faker->sentence,
            'short_description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'cv_id' => CV::factory()->create()->id,
        ];
    }
}