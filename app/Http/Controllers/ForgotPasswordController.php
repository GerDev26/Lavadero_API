<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    public function getPasswordToken(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json("No existe el email $request->email", 404);
        }
        $token = PasswordReset::create([
            'email' => $request->email,
            'token' => Str::random(60),
            'created_at' => now()
        ]);
        Mail::to($request->email)->send(new ForgotPassword($token, $user));
        return response()->json(['message' => 'Se envio el token con exito']);
    }
    public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'token' => 'exists:password_reset_tokens,token|required|string',
            'password' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $passwordToken = PasswordReset::where('token', $request->token)->firstOrFail();
        $user = User::where('email', $passwordToken->email)->firstOrFail();

        $user->password = $request->password;
        $user->save();

        PasswordReset::where('email', $passwordToken->email)->delete();
        return response()->json(['message' => 'Se reinicio la contraseña']);
    }
    
}
