<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Resources;


use Transave\ScolaCvManagement\Http\Models\Faculty;
use Transave\ScolaCvManagement\Tests\TestCase;

class GetResourceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->testData();
    }
    /** @test */
    function can_get_single_faculty()
    {
        $faculty = Faculty::query()->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/faculties/$faculty->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        Faculty::factory()->count(10)->create();
    }
}