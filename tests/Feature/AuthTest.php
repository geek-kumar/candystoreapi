<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;


class AuthTest extends TestCase
{
    //use RefreshDatabase;

    private $userMock;
    public function setup():void
    {
        parent::setup();
        $user = User::factory()->make();
        $pass  = Passport::actingAs($user, 'api');

        $this->userMock = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ];
    }

   
    public function test_authenticated_user()
    {
        $response = $this->get('api/user');

        $response->assertOk();
    } 

     public function test_user_register()
    {
        $response = $this->postJson('api/register',
            $this->userMock
        );
        $response->assertStatus(201);
        $response->assertJsonStructure([

            "user"=>[
                "id",
                "name",
                "email",
                "updated_at",
                "created_at",   
            ],
            "token"
        ]);
    } 

}
