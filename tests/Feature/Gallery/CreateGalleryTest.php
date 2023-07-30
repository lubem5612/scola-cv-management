<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Gallery;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateGalleryTest extends TestCase
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
    function can_create_gallery_successfully()
    {
        $request = [
            'cv_id' => CV::factory()->create()->id,
            'photo' => UploadedFile::fake()->image('image.jpg')
        ];
        $response = $this->json('POST', "/cv/galleries", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}