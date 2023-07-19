<?php

namespace Transave\ScolaCvManagement\Tests\Feature\Publication;

use Laravel\Sanctum\Sanctum;
use Transave\ScolaCvManagement\Actions\Publication\GetPublicationByID;
use Transave\ScolaCvManagement\Actions\Publication\GeneralPublicationList;
use Transave\ScolaCvManagement\Actions\Publication\SearchPublication;
use Transave\ScolaCvManagement\Actions\Publication\SingleUserPublicationList;
use Transave\ScolaCvManagement\Http\Models\Publication;
use Transave\ScolaCvManagement\Tests\TestCase;

class SearchPublicationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Publication::factory()->count(10)->create();
    }

    /** @test */
    public function can_search_publication_via_action()
    {
        $response = (new SearchPublication(Publication::class, []))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_publication_via_action_with_relationship()
    {
        $response = (new SearchPublication(Publication::class, ['CV']))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }

    /** @test */
    public function can_search_single_publication_via_action_with_relationship()
    {
        $publication = Publication::query()->inRandomOrder()->first();
        $response = (new GetPublicationByID(['id' => $publication->id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }



    /** @test */
    public function can_search_user_publications_via_action_with_relationship()
    {
        $publication = Publication::query()->inRandomOrder()->first();
        $response = (new SingleUserPublicationList(['cv_id' => $publication->cv_id]))->execute();
        $array = json_decode($response->getContent(), true);
        $this->assertEquals(true, $array['success']);
        $this->assertNotNull($array['data']);
    }
}
