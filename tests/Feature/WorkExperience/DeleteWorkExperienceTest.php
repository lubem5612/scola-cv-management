<?php

namespace Transave\ScolaCvManagement\Tests\Feature\WorkExperience;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\WorkExperience;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteWorkExperienceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        WorkExperience::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_workExperience_successfully()
    {
        $workExperience = WorkExperience::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/work_experiences/delete/{$workExperience->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}