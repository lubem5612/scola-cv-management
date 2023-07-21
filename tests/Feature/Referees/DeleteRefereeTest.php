<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Referees;


use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Referee;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteRefereeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Referee::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_referee_successfully()
    {
        $referee = Referee::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/referees/delete/{$referee->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}