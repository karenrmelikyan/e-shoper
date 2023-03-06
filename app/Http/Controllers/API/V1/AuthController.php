<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;


class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userResource = new AuthResource($user);
            $token = $user?->createToken($user?->name)->plainTextToken;

            return response()->json(['user' => $userResource, 'token' => $token], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registration(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $credentials['password'] = Hash::make($request->password);

        $user = User::create($credentials);

        $userResource = new AuthResource($user);
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json(['user' => $userResource, 'token' => $token], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function authChecking(Request $request): JsonResponse
    {
        $token = $request->bearerToken();
        $user = PersonalAccessToken::findToken($token)->tokenable;

        if ($user) {
            $userResource = new AuthResource($user);

            return response()->json(['user' => $userResource, 'token' => $token], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
