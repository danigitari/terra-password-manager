<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\log;
use App\Models\Credential;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

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

    public function editUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->department = $request->department;
        $user->save();

        return response()->json([
            'message' => 'User Updated Successfully',
        ]);
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return response()->json([
            'message' => 'User Deleted Successfully',
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
            'department' => $request->department,
        ]);

        return response()->json([
            'message' => 'Credential Created Successfully',
        ]);
    }

    public function editCredential(Request $request)
    {
        $credential = Credential::find($request->id);
        $credential->name = $request->name;
        $credential->password = Hash::make($request->password);
        $credential->organization = $request->organization;
        $credential->notes = $request->notes;
        $credential->department = $request->departments;
        $credential->save();

        return response()->json([
            'message' => 'Credential Updated Successfully',
        ]);
    }

    public function deleteCredential(Request $request)
    {
        $credential = Credential::find($request->id);
        $credential->delete();

        return response()->json([
            'message' => 'Credential Deleted Successfully',
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
            $userCount = User::count();
            return response()->json([
                'users' => $users,
                'userCount' => $userCount,
            ]);

    }


    public function getCredentials()
    {
        $credentials = Role::all();
        $credentialCount = Credential::count();
        return response()->json([
            'credentials' => $credentials,
            'credentialCount' => $credentialCount,

        ]);
    }

    public function getRoles()
    {
        $roles = Role::all();
        $roleCount = Role::count();
        return response()->json([
            'roles' => $roles->toArray(),
            'roleCount' => $roleCount,

        ]);
    }
}
