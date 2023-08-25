<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class AdminController extends Controller
{
    use HasRoles;
    public function createUsers(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->name,
            'phone_number' => $request->phone_number,
        ])->assignRole($request->department);

        return response()->json([
            'message' => 'User Created Successfully',
        ]);
    }
    public function addNewAdmin(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->name,
            'phone_number' => $request->phone_number,
        ])->assignRole($request->admin);

        return response()->json([
            'message' => 'AdminCreated Successfully',
        ]);
    }

    public function createNewCredential(Request $request)
    {
        Credential::create([
            'name' => $request->name,
            'password' => Hash::make($request->credentials),
            'organization' => $request->organization,
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

    public function getUsers()
    {      $users = User::all();
            return response()->json([
                'users' => $users,
            ]);

    }


    public function getCredentials()
    {
        $credentials = Credential::all();
        return response()->json([
            'credentials' => $credentials,
        ]);
    }
}
