<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;


class CVModelTest extends TestCase
{
    private $cv;

    public function setUp(): void
    {
        parent::setUp();
        $this->cv = CV::factory()->create();
    }

    /** @test */
    public function cv_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->cv instanceof CV);
    }

    /** @test */
    public function cv_table_exists_in_database()
    {
        $this->assertModelExists($this->cv);
    }
}
