<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Publication;


use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeletePublicationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Publication::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_publication_successfully()
    {
        $publication = Publication::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/publications/{$publication->id}");
        $response->assertStatus(200);

        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}