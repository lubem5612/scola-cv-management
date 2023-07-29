<?php
namespace Transave\ScolaCvManagement\Tests\Unit\Models;

use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Tests\TestCase;


class CredentialModelTest extends TestCase
{
    private $credential;

    public function setUp(): void
    {
        parent::setUp();
        $this->credential=Credential::factory()->create();
    }

    /** @test */
    public function credential_model_can_be_initiated_with_factory()
    {
        $this->assertTrue($this->credential instanceof Credential);
    }

    /** @test */
    public function credential_table_exists_in_database()
    {
        $this->assertModelExists($this->credential);
    }
}
