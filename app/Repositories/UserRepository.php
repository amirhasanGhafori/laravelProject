<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{

    /**
     * @param Request $request
     */
    public function create(Request $request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    }

}
