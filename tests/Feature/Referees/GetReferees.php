<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Referees;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Referee;
use Transave\ScolaCvManagement\Tests\TestCase;

class GetReferees extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Referee::factory()->count(10)->create();
    }

    /** @test */
    function can_get_single_user_referees()
    {
        $referee = Referee::query()->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/referees/show/{$referee->cv_id}");
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
        $this->assertEquals($array['data']['cv_id'], $referee->cv_id);
    }

}