<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Achievement;

use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class CreateAchievementTest extends TestCase
{

    private $request, $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }


    /** @test */
    function can_create_achievement_successfully()
    {
        $request = [
            'description' => $this->faker->sentence,
            'title' => $this->faker->title,
            'date_achieved' => $this->faker->date,
            'cv_id' => CV::factory()->create()->id,
        ];
        $response = $this->json('POST', "/cv/achievements/store", $request);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }
}