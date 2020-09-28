<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * register users
     * @method post
     * @param Request $request
     */
    public function register(Request $request){
        $request->validate([
           'name'=>['required'],
           'email'=>['required','email','unique:users'],
           'password'=>['required'],
        ]);

        resolve(UserRepository::class)->create($request);


        return response()->json([
            'message'=>'create user successfully'
        ],201);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request){

        $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
        ]);

        if (Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),200);
        }


        throw ValidationException::withMessages([
            'email'=>'incorrect email address'
        ]);


    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json([
            'message'=>'logout successfully'
        ],200);


    }

}
