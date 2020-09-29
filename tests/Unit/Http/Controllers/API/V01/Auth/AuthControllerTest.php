<?php

namespace Http\Controllers\API\V01\Auth;

use App\Http\Controllers\API\V01\Auth\AuthController;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    public function testRegister()
    {
         $response = $this->post(route('auth.register'),[
             'name'=>"amirhasan",
             'email'=>'amirhasan@gmail.com',
             'password'=>123456
         ]);

         $response->assertStatus(Response::HTTP_CREATED);
    }
}
