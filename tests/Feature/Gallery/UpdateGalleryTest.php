<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Gallery;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Gallery;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateGalleryTest extends TestCase
{
    private $faker, $gallery;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
        $this->gallery = Gallery::factory()->create();
    }

    /** @test */
    function can_update_gallery_successfully()
    {
        $request = [
            'gallery_id' => $this->gallery->id,
            'cv_id' => CV::factory()->create()->id,
            'photo' => UploadedFile::fake()->image('image.jpg')
        ];
        $response = $this->json('POST', "/cv/galleries/{$this->gallery->id}", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}