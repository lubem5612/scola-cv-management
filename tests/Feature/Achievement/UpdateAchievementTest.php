<?php
namespace Transave\ScolaCvManagement\Tests\Feature\Achievement;

use Faker\Factory;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Achievement;

use Transave\ScolaCvManagement\Tests\TestCase;

class UpdateAchievementTest extends TestCase
{
    private $faker, $request;

    public function setUp(): void
    {
        parent::setUp();
        Achievement::factory()->count(10)->create();
        $this->testData();
    }


    /** @test */

    public function can_update_achievement()
    {
        $achievement = Achievement::query()->first();
        $response = $this->json('POST', "/cv/achievements/{$achievement->id}", $this->request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }

    private function testData()
    {
        $this->faker = Factory::create();
        $this->request = [
            'description' => $this->faker->sentence,
            'date_achieved' => $this->faker->date,
            'title' => $this->faker->title,
            'cv_id' => CV::factory()->create()->id,
        ];
    }
}