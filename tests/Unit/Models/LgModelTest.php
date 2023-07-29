<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Lg;
use Transave\ScolaCvManagement\Tests\TestCase;


class LgModelTest extends TestCase
{
    private $lg;

    public function setUp(): void
    {
        parent::setUp();
        $this->lg = Lg::factory()->create();
    }

    /** @test */
    public function lg_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->lg instanceof Lg);
    }

    /** @test */
    public function lg_table_exists_in_database()
    {
        $this->assertModelExists($this->lg);
    }
}
