<?php
//namespace Transave\ScolaCvManagement\Tests\Feature\Auth;
//
//use Faker\Factory;
//use Transave\ScolaCvManagement\Actions\Auth\CreateAccount;
//use Transave\ScolaCvManagement\Tests\TestCase;
//
//class RegisterTest extends TestCase
//{
//    private $request;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->getTestData();
//    }
//    /** @test */
//    public function can_register_user_via_actions()
//    {
//        $response = (new CreateAccount($this->request))->execute();
//        $this->assertEquals(true, 'success');
//        $this->assertNotNull($response['data']);
//    }
//
//
//    /** @test */
//    public function can_register_account_successfully()
//    {
//        $response = $this->json('POST', route('api/register'), $this->request, ['Accept' => 'application/json']);
//        $response->assertStatus(200);
//        $response->assertJsonStructure(["success", "message", "data"]);
//
//        $json = json_decode($response->getContent(), true);
//        $this->assertEquals(true, $json['success']);
//        $this->assertNotNull($json['data']);
//    }
//
//    private function getTestData()
//    {
//        $faker = Factory::create();
//        $this->request = [
//            'email' => $faker->email,
//            'firstName' => 'james',
//            'lastName' => 'mark',
//            'department_id' =>  '232',
//            'faculty_id' =>  '387',
//            'user_type' => 'user',
//            'password' => 'password1234',
//            'password_confirmation' => 'password1234',
//
//        ];
//    }
//
//}
