<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\EducationalQualification;
use Transave\ScolaCvManagement\Tests\TestCase;


class EducationalQualificationModelTest extends TestCase
{
    private $educationalQualification;

    public function setUp(): void
    {
        parent::setUp();
        $this->educationalQualification = EducationalQualification::factory()->create();
    }

    /** @test */
    public function educational_Qualification_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->educationalQualification instanceof EducationalQualification);
    }

    /** @test */
    public function educational_Qualification_table_exists_in_database()
    {
        $this->assertModelExists($this->educationalQualification);
    }
}
