<?php

namespace Transave\ScolaCvManagement\Tests\Feature\WorkExperience;

use Transave\ScolaCvManagement\Actions\WorkExperience\SearchWorkExperience;
use Transave\ScolaCvManagement\Actions\WorkExperience\SingleUserWorkExperience;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchWorkExperienceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        WorkExperience::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_workExperience_via_action()
    {
        $response = (new SearchWorkExperience(WorkExperience::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_workExperience_via_action_with_relationship()
    {
        $response = (new SearchWorkExperience(WorkExperience::class, ['CV']))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }


    /** @test */
    public function can_search__single_user_workExperience_via_action_with_relationship()
    {
        $workExperience = WorkExperience::query()->inRandomOrder()->first();
        $response = (new SingleUserWorkExperience(['cv_id' => $workExperience->cv_id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }
}
