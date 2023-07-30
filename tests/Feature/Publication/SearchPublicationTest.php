<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Publication;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchPublicationTest extends TestCase
{
    private $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create();
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_fetch_all_publications()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/publications');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(20, $arrayData['data']);
    }

    /** @test */
    function can_fetch_paginated_publications()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/publications?per_page=5');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(5, $arrayData['data']['data']);
    }

    /** @test */
    function can_fetch_publications_with_search_term()
    {
        $this->getTestData('this is my first publication');
        $response = $this->json('GET', '/cv/publications?search=first');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(10, $arrayData['data']);
    }

    /** @test */
    function can_fetch_publication_with_specific_id()
    {
        $this->getTestData();
        $item = Publication::query()->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/publications/$item->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }


    private function getTestData($short_description=null)
    {
        $search = is_null($short_description)? $this->faker->sentence(2): $short_description;

        Publication::factory()->count(10)->for(CV::factory())->create();
        Publication::factory()->count(10)->for(CV::factory())->create(['short_description' => $search]);
    }
}