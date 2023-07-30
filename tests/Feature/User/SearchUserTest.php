<?php


namespace Transave\ScolaCvManagement\Tests\Feature\User;


use Faker\Factory;
use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchUserTest extends TestCase
{
    private $faker;
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $user = config('scolacv.auth_model')::factory()->create(['user_type' => 'admin']);
        Sanctum::actingAs($user);
    }

    /** @test */
    function can_fetch_all_users_that_are_not_admin()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/users');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(20, $arrayData['data']);
    }

    /** @test */
    function can_fetch_all_users_that_are_admins()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/users?only_admin=true');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(2, $arrayData['data']);
    }

    /** @test */
    function can_fetch_paginated_users()
    {
        $this->getTestData();
        $response = $this->json('GET', '/cv/users?per_page=5');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(5, $arrayData['data']['data']);
    }

    /** @test */
    function can_fetch_users_with_search_term()
    {
        $this->getTestData('Scolar Mister');
        $response = $this->json('GET', '/cv/users?search=Scola');
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
        $this->assertCount(10, $arrayData['data']);
    }

    /** @test */
    function can_fetch_users_with_specific_id()
    {
        $this->getTestData();
        $item = config('scolacv.auth_model')::query()->where('user_type', '!=', 'admin')->inRandomOrder()->first();
        $response = $this->json('GET', "/cv/users/$item->id");
        $response->assertStatus(200);
        $arrayData = json_decode($response->getContent(), true);
        $this->assertEquals(true, $arrayData['success']);
        $this->assertNotNull($arrayData['data']);
    }


    private function getTestData($name=null)
    {
        $search = is_null($name)? $this->faker->sentence(2): $name;

        config('scolacv.auth_model')::factory()->count(10)->create(['user_type' => 'user']);
        config('scolacv.auth_model')::factory()->count(10)->create(['first_name' => $search, 'user_type' => 'user']);
    }
}