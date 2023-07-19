<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Achievement;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\Achievement\GetAchievementByID;
use Transave\ScolaCvManagement\Actions\Achievement\GeneralAchievementList;
use Transave\ScolaCvManagement\Actions\Achievement\SearchAchievement;
use Transave\ScolaCvManagement\Actions\Achievement\SingleUserAchievementList;
use Transave\ScolaCvManagement\Http\Models\Achievement;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchAchievementTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Achievement::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_achievement_via_action()
    {
        $response = (new SearchAchievement(Achievement::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_achievement_via_action_with_relationship()
    {
        $response = (new SearchAchievement(Achievement::class, ['CV']))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_single_achievement_via_action_with_relationship()
    {
        $achievement = Achievement::query()->inRandomOrder()->first();
        $response = (new GetAchievementByID(['id' => $achievement->id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }



    /** @test */
    public function can_search_user_achievements_via_action_with_relationship()
    {
        $achievement = Achievement::query()->inRandomOrder()->first();
        $response = (new SingleUserAchievementList(['cv_id' => $achievement->cv_id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }
}
