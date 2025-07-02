<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['Invalid credentials']]);
        }

        $existingToken = $user->tokens()
            ->where('name', 'libretto-token')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($existingToken) {
            return response()->json([
                'token' => $existingToken->plainTextToken ?? $existingToken->token,
                'message' => 'Token reused'
            ]);
        }

        $user->tokens()->where('name', 'libretto-token')->delete();

        $tokenResult = $user->createToken('libretto-token');
        $token = $tokenResult->plainTextToken;
        $tokenModel = $user->tokens()->where('name', 'libretto-token')->first();
        $tokenModel->expires_at = Carbon::now()->addDay();
        $tokenModel->save();

        return response()->json(['token' => $token, 'message' => 'New token generated']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

