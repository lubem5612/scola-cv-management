<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Qualification;
use Transave\ScolaCvManagement\Tests\TestCase;


class QualificationModelTest extends TestCase
{
    private $qualification;

    public function setUp(): void
    {
        parent::setUp();
        $this->qualification = Qualification::factory()->create();
    }

    /** @test */
    public function qualification_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->qualification instanceof Qualification);
    }

    /** @test */
    public function qualification_table_exists_in_database()
    {
        $this->assertModelExists($this->qualification);
    }
}
