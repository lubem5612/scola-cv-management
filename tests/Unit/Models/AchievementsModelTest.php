<?php

namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Achievement;
use Transave\ScolaCvManagement\Tests\TestCase;


class AchievementsModelTest extends TestCase
{
    private $achievement;
    public function setUp(): void
    {
        parent::setUp();
        $this->achievement = Achievement::factory()->create();
    }

    /** @test */
    public function achievement_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->achievement instanceof Achievement);
    }

    /** @test */
    public function achievement_table_exists_in_database()
    {
        $this->assertModelExists($this->achievement);
    }
}
