<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function CopiedCredentials(Request $request){
        $user = auth()->user();
        $all_credentials_copied = $user->log->all_credentials_copied;
        return response()->json([
            'message' => 'All Credentials Copied',
            'all_credentials_copied' => $all_credentials_copied,
        ]);

    }
}
