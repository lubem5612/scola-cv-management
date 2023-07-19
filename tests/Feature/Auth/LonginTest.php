<?php
//
//namespace Transave\ScolaCvManagement\Tests\Feature\Auth;
//
//
//use Laravel\Sanctum\Sanctum;
//use Transave\ScolaCvManagement\Http\Models\User;
//use Transave\ScolaCvManagement\Tests\TestCase;
//
//class LoginTest extends TestCase
//{
//    private $user;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->user = User::factory()->create([
//            'email' => 'sampledata@test.com',
//            'password' => bcrypt('sample1234'),
//        ]);
//    }
//
//    /** @test */
//    public function can_login_user_successfully()
//    {
//        $loginData = ['email' => 'sampledata@test.com', 'password' => 'sample1234'];
//        Sanctum::actingAs($this->user);
//
//        $response = $this->json('POST', route('cv.login'), $loginData, ['Accept' => 'application/json']);
//        $response->assertStatus(200)->assertJsonStructure(["success", "message", "data"]);
//
//        $this->assertAuthenticated();
//    }
//
//
//
////    /** @test */
////    public function can_logout_authenticated_user()
////    {
////        Sanctum::actingAs($this->user);
////        $response = $this->json('POST', route('logout'), []);
////        $response->assertStatus(200);
////    }
//}
