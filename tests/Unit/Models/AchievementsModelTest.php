<?php

namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Achievements;
use Orchestra\Testbench\TestCase;

class AchievementsModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_achievement_model_exists()
    {
        $this->assertTrue(class_exists(Achievements::class), 'Achievements model does not exist.');
    }
}
