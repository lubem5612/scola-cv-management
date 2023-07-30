<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Schools;


use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\School;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteSchoolTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        School::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_school_successfully()
    {
        $school = School::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/schools/delete/{$school->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}