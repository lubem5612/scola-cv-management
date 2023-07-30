<?php


namespace Transave\ScolaCvManagement\Tests\Feature\User;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteUserTest extends TestCase
{
    private $faker, $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($this->user);
    }

    /** @test */
    public function can_delete_user_successfully()
    {
        $response = $this->json('DELETE', "/cv/users/{$this->user->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}