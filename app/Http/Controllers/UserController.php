<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        # code...
        $fields = $request->validate([
            'email' => 'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response(
                [
                    "message"=>"Erreur d'identifiant"
                ],401
            );
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];  
        return response($response,201);
    }
}
