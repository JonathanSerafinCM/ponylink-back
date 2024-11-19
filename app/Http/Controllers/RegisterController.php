<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (QueryException $e) {
            if ($e->getCode() === '23505') {
                return response()->json([
                    'msg' => 'El correo electrónico ya está registrado.'
                ], 422);
            }
            return response()->json([
                'msg' => 'Error al registrar usuario.'
            ], 500);
        }
    }
    public function showRegisterForm()
    {
        return view('auth.registro');
    }

}