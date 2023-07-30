<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Specialization;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\Specialization\SearchSpecialization;
use Transave\ScolaCvManagement\Actions\Specialization\AllUsersSpecializationList;
use Transave\ScolaCvManagement\Actions\Specialization\SingleUserSpecializations;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchSpecializationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Specialization::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_specialization_via_action()
    {
        $response = (new SearchSpecialization(Specialization::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_specialization_via_action_with_relationship()
    {
        $response = (new SearchSpecialization(Specialization::class, ['CV']))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function test_users_can_search_only_their_specialization_via_action()
    {
        $specialization = Specialization::query()->inRandomOrder()->first();
        $response = (new SingleUserSpecializations(['cv_id' => $specialization->cv_id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }


}
