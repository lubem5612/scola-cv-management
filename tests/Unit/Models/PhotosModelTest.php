<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Gallery;
use Orchestra\Testbench\TestCase;


class PhotosModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Photos_model_exists()
    {
        $this->assertTrue(class_exists(Gallery::class), 'Photos model does not exist.');
    }
}
