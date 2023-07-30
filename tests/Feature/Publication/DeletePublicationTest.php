<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Publication;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeletePublicationTest extends TestCase
{
    private $faker, $publication;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->publication = Publication::factory()->create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    public function can_delete_publication_successfully()
    {
        $response = $this->json('DELETE', "/cv/publications/{$this->publication->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}