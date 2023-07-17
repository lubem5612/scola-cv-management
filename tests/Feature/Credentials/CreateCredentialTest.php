<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Credentials;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateCredentialTest extends TestCase
{
    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_create_credential_successfully()
    {
        $request = [
            'slug' => $this->faker->name,
            'cv_id' => CV::factory()->create()->id,
            'file' => UploadedFile::fake()->create('file.pdf', '500', 'application/pdf')
        ];
        $response = $this->json('POST', "/cv/credentials", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}