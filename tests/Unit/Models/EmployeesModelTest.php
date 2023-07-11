<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\CvUpload;
use Orchestra\Testbench\TestCase;


class EmployeesModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_check_if_Employees_model_exists()
    {
        $this->assertTrue(class_exists(CvUpload::class), 'CvUpload model does not exist.');
    }
}
