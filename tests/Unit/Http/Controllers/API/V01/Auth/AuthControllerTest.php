<?php

namespace Http\Controllers\API\V01\Auth;

use App\Http\Controllers\API\V01\Auth\AuthController;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    public function test_register_should_be_validate()
    {
        $response = $this->post(route('auth.register'));
        $response->assertStatus(500);
    }
}
