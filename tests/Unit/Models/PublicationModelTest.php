<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;


class PublicationModelTest extends TestCase
{
    private $publication;

    public function setUp(): void
    {
        parent::setUp();
        $this->publication = Publication::factory()->create();
    }

    /** @test */
    public function publication_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->publication instanceof Publication);
    }

    /** @test */
    public function publication_table_exists_in_database()
    {
        $this->assertModelExists($this->publication);
    }
}
