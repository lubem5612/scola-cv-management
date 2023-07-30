<?php
namespace Transave\ScolaCvManagement\Tests\Feature\Referees;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Referee;
use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateRefereeTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        Referee::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_referee()
    {
        $referee = Referee::query()->first();
        $response = $this->json('PATCH', "/cv/referees/update/{$referee->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'cv_id' => CV::factory()->create()->id,
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'place_of_work' => $this->faker->country,
            'contact' => $this->faker->phoneNumber,
            'relationship' => $this->faker->word
        ];
    }
}