<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Referee;
use Transave\ScolaCvManagement\Tests\TestCase;


class RefereeModelTest extends TestCase
{
    private $referee;

    public function setUp(): void
    {
        parent::setUp();
        $this->referee = Referee::factory()->create();
    }

    /** @test */
    public function referee_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->referee instanceof Referee);
    }

    /** @test */
    public function referee_table_exists_in_database()
    {
        $this->assertModelExists($this->referee);
    }
}
