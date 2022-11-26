<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store()
    {
        $user = User::create([
            'api_token' => Str::Random(60),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'token' => $user->api_token,
        ], 201);
    }
}