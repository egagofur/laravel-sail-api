<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:8'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.'],
      ]);
    }

    return response()->json([
      'message' => 'login sucess',
      'success' => true,
      'data' => [
        'token' => $user->createToken($request->email)->plainTextToken,
        'user' => $user
      ]
    ], 200);
  }

  public function logout(Request $request)
  {
    $currentUser = $request->user();
    $currentUser->tokens()->delete();
    return response()->json(
      [
        'message' => 'logout sucess',
        'success' => true,
        'data' => null
      ],
      200
    );
  }
}
