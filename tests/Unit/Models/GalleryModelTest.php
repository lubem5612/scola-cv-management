<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Gallery;
use Transave\ScolaCvManagement\Tests\TestCase;


class GalleryModelTest extends TestCase
{
    private $gallery;

    public function setUp(): void
    {
        parent::setUp();
        $this->gallery = Gallery::factory()->create();
    }

    /** @test */
    public function gallery_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->gallery instanceof Gallery);
    }

    /** @test */
    public function gallery_table_exists_in_database()
    {
        $this->assertModelExists($this->gallery);
    }
}
