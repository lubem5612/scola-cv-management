<?php


namespace Transave\ScolaCvManagement\Tests\Feature\Credentials;


use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Http\Models\Credential;
use Transave\ScolaCvManagement\Http\Models\CV;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchCredentialsTest extends TestCase
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
    function can_fetch_all_credentials()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/credentials');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(20, $arrayData['data']);
    }

    /** @test */
    function can_fetch_paginated_credentials()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/credentials?per_page=5');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(5, $arrayData['data']['data']);
    }

    /** @test */
    function can_fetch_credentials_with_search_term()
    {

        $this->getTestData('lagos boys');
        $response = $this->json('GET', '/cv/credentials?search=lagos');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(10, $arrayData['data']);
    }

    /** @test */
    function can_fetch_credentials_within_interval()
    {
        $this->getTestData(null, Carbon::now());
        $start = Carbon::now()->subMonths(3)->format('Y-m-d');
        $end = Carbon::now()->subDays(2)->format('Y-m-d');
        $response = $this->json('GET', '/cv/credentials?start='.$start.'&end='.$end);
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(10, $arrayData['data']);
    }

    /** @test */
    function can_fetch_credentials_with_specific_id()
    {
        $this->getTestData(null, Carbon::now());
        $credential = Credential::query()->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/credentials/$credential->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }


    private function getTestData($slug=null, $start_date=null)
    {
        $_slug = is_null($slug)? $this->faker->sentence(4): $slug;
        $_start = is_null($start_date)? Carbon::now() : Carbon::parse($start_date)->subDays(3);

        Credential::factory()->count(10)->for(CV::factory())->create();
        Credential::factory()->count(10)->for(CV::factory())->create(['slug' => Str::slug($_slug, '-'), 'created_at' => $_start]);
    }
}