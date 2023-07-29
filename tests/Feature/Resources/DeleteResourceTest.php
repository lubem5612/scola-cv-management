<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Resources;


use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteResourceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->testData();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }
    /** @test */
    function can_delete_faculty_successfully()
    {
        $faculty = Faculty::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/faculties/$faculty->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }

    private function testData()
    {
        Faculty::factory()->count(10)->create();
    }
}