<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Country;
use Transave\ScolaCvManagement\Tests\TestCase;


class CountryModelTest extends TestCase
{
    private $country;

    public function setUp(): void
    {
        parent::setUp();
        $this->country=Country::factory()->create();
    }

    /** @test */
    public function country_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->country instanceof Country);
    }

    /** @test */
    public function country_table_exists_in_database()
    {
        $this->assertModelExists($this->country);
    }
}
