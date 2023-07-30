<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Credentials;


use Faker\Factory;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateCredentialTest extends TestCase
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
    function can_update_credential_successfully()
    {
        $credential = Credential::factory()->create();
        $request = [
            'slug' => $this->faker->name,
            'cv_id' => CV::factory()->create()->id,
            'file' => UploadedFile::fake()->create('file.pdf', '500', 'application/pdf'),
            'credential_id' => $credential->id,
        ];
        $response = $this->json('POST', "/cv/credentials/$credential->id", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}