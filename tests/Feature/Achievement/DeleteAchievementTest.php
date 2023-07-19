<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Achievement;


use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteAchievementTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Achievement::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_achievement_successfully()
    {
        $achievement = Achievement::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/achievements/{$achievement->id}");
        $response->assertStatus(200);

        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}