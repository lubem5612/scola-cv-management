<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Gallery;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Gallery;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteGalleryTest extends TestCase
{
    private $faker, $gallery;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->gallery = Gallery::factory()->create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    public function can_delete_gallery_successfully()
    {
        $response = $this->json('DELETE', "/cv/galleries/{$this->gallery->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}