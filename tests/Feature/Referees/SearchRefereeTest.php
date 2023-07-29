<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Referees;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\Referees\SearchReferees;
use Transave\ScolaCvManagement\Actions\Referees\AllUsersRefereesList;
use Transave\ScolaCvManagement\Actions\Referees\SingleUserReferees;
use Transave\ScolaCvManagement\Http\Models\Referee;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchRefereeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Referee::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_referee_via_action()
    {
        $response = (new SearchReferees(Referee::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_referee_via_action_with_relationship()
    {
        $response = (new SearchReferees(Referee::class, ['CV']))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_only_their_referees_via_action_with_relationship()
    {
        $referee = Referee::query()->inRandomOrder()->first();
        $response = (new SingleUserReferees(['cv_id' => $referee->cv_id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }
}
