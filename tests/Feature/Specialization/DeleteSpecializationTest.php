<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Specialization;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Specialization;
use Transave\ScolaCvManagement\Tests\TestCase;

class DeleteSpecializationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Specialization::factory()->count(20)->create();
    }

    /** @test */
    function can_delete_specialization_successfully()
    {
        $specialization = Specialization::query()->inRandomOrder()->first();
        $response = $this->json('DELETE', "/cv/specializations/delete/{$specialization->id}");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNull($arrayData['data']);
    }
}