<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function createUsers(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
        ])->assignRole($request->department);

        return response()->json([
            'message' => 'User Created Successfully',
        ]);
    }

    public function createNewCredential(Request $request)
    {
        Credential::create([
            'name' => $request->name,
            'credential' => Hash::make($request->credentials),
            'notes' => $request->notes,
        ])->assignRole($request->department);

        return response()->json([
            'message' => 'Credential Created Successfully',
        ]);
    }
    public function createNewRole(Request $request)
    {
        Role::create([
            'name' => $request->department,
        ]);
        
        return response()->json([
            'message' => 'Department Created Successfully',
        ]);
    }
}
