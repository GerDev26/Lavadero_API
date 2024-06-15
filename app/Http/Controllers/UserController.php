<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(){
        return User::with('role')->get();
    }
    public function Store(StoreUserRequest $request){

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'key' => $request->key,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json($user, 201);
    }
    public function Hola(Request $request){
        return $request;
    }
}
