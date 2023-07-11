<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\User;
use Orchestra\Testbench\TestCase;

class UserModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Schools_model_exists()
    {
        $this->assertTrue(class_exists(User::class), 'User model does not exist.');
    }
}
