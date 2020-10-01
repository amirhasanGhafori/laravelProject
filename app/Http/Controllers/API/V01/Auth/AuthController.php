<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>['required'],
            'email'=>['required','email','unique:users'],
            'password'=>['required']
        ]);

        $user = resolve(UserRepository::class)->create($request);

        $defaultSuperAdminEmail = config('permission.default_super_admin_email');
        $user->email == $defaultSuperAdminEmail ? $user->assignRole('Super Admin') : $user->assignRole('User');


        return response()->json([
            'message'=>'User Created Successfully'
        ],Response::HTTP_OK);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        if (Auth::attempt($request->only(['email','password']))){
            return response()->json(Auth::user(),Response::HTTP_OK);
        }

//        throw ValidationException::withMessages([
//            'email'=>'incorrect validation email'
//        ]);
        return \response()->json('failde',Response::HTTP_OK);

    }

    public function user()
    {
        \response()->json(Auth::user(),Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return \response()->json([
            'message'=>'logout successfully'
        ],Response::HTTP_OK);
    }



}
