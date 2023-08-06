<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   public function register(Request $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Registration Successful',
            'user' => $user,
            'token' => $token,
        ]);
}

    Public function login(Request $request) 
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // dd($request);

            return response()->json([
                'message' => 'Invalid Credentials',
            ], 401);
        
        } 
            
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Login Successful',
            'user' => $user,
            'token' => $token,
       
        ] , 200);
         
    }
}
