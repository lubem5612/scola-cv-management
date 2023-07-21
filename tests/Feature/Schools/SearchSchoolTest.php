<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Schools;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\School\SearchSchool;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchSchoolTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        School::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_school_via_action()
    {
        $response = (new SearchSchool(School::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

}
