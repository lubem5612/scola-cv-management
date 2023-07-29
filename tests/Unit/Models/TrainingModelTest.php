<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Training;
use Transave\ScolaCvManagement\Tests\TestCase;


class TrainingModelTest extends TestCase
{
    private $training;

    public function setUp(): void
    {
        parent::setUp();
        $this->training = Training::factory()->create();
    }

    /** @test */
    public function training_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->training instanceof Training);
    }

    /** @test */
    public function training_table_exists_in_database()
    {
        $this->assertModelExists($this->training);
    }
}
