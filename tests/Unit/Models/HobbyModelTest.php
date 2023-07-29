<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Hobby;
use Transave\ScolaCvManagement\Tests\TestCase;


class HobbyModelTest extends TestCase
{
    private $hobby;

    public function setUp(): void
    {
        parent::setUp();
        $this->hobby = Hobby::factory()->create();
    }

    /** @test */
    public function hobby_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->hobby instanceof Hobby);
    }

    /** @test */
    public function hobby_table_exists_in_database()
    {
        $this->assertModelExists($this->hobby);
    }
}
