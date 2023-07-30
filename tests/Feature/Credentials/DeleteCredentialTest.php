<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Credentials;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteCredentialTest extends TestCase
{
    private $faker, $credential;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->credential = Credential::factory()->create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    public function can_delete_credential_successfully()
    {
        $response = $this->json('DELETE', "/cv/credentials/{$this->credential->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}