<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($validated)) {
            // login sucess
            $token = $request->user()->createToken('Mitoken');
            return response()->json([
                'token' => $token->plainTextToken
            ]);
        } else {
            // invalid credentials
            return response()->json([
                'msg' => 'usuario y/o contrasena invalida'
            ]);
        }
    }
    public function showLoginForm()
    {
        return view('auth.inicio');
    }
    
}
