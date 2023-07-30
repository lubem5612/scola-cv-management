<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Gallery;


use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Http\Models\Gallery;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchGalleryTest extends TestCase
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
    function can_fetch_all_galleries()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/galleries');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(20, $arrayData['data']);
    }

    /** @test */
    function can_fetch_paginated_galleries()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/galleries?per_page=5');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(5, $arrayData['data']['data']);
    }

    /** @test */
    function can_fetch_galleries_with_search_term()
    {

        $this->getTestData('my picture one');
        $response = $this->json('GET', '/cv/galleries?search=picture');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(10, $arrayData['data']);
    }

    /** @test */
    function can_fetch_gallery_with_specific_id()
    {
        $this->getTestData(null, Carbon::now());
        $item = Gallery::query()->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/galleries/$item->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }


    private function getTestData($slug=null, $start_date=null)
    {
        $_slug = is_null($slug)? $this->faker->sentence(4): $slug;
        $_start = is_null($start_date)? Carbon::now() : Carbon::parse($start_date)->subDays(3);

        Gallery::factory()->count(10)->for(CV::factory())->create(['created_at' => Carbon::now()]);
        Gallery::factory()->count(10)->for(CV::factory())->create(['slug' => Str::slug($_slug, '-'), 'created_at' => $_start]);
    }
}