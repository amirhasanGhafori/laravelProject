<?php

namespace Http\Controllers\API\V01\Auth;

use App\Http\Controllers\API\V01\Auth\AuthController;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;
    //test register

    public function testRegister()
    {
        $response = $this->postJson(route('user.register'),[
            'name'=>'amirhasan11a',
            'email'=>'amirhasan1a@gmail.com',
            'password'=>13771120
        ]);
        $response->assertStatus(Response::HTTP_OK);

    }


    #test login

    public function testLogin()
    {
        $user = \App\Models\User::factory()->make();
        $response = $this->actingAs($user)->postJson(route('user.login'),[
            'email'=>'amirhasan1a@gmail.com',
            'password'=>13771120
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_show_user_logged_in()
    {
        $response = $this->get(route('user.show'));
        $response->assertStatus(Response::HTTP_OK);
    }


    public function test_logged(){
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->postJson(route('user.logout'));
        $response->assertStatus(Response::HTTP_OK);
    }

}

