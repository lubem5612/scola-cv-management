<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Publication;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreatePublicationTest extends TestCase
{
    private $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_create_publication_successfully()
    {
        $request = [
            'cv_id' => CV::factory()->create()->id,
            'link' => $this->faker->url,
            'description' => $this->faker->sentence(30),
            'short_description' => $this->faker->sentence
        ];
        $response = $this->json('POST', "/cv/publications", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}