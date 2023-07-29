<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\State;
use Transave\ScolaCvManagement\Tests\TestCase;


class StateModelTest extends TestCase
{
    private $state;

    public function setUp(): void
    {
        parent::setUp();
        $this->state = State::factory()->create();
    }

    /** @test */
    public function state_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->state instanceof State);
    }

    /** @test */
    public function state_table_exists_in_database()
    {
        $this->assertModelExists($this->state);
    }
}
