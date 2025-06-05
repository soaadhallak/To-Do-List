<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $data=$request->validated();
        $invitation=Invitation::where('token',$request->token)->where('used','false')->first();
        if(!$invitation){
            return response()->json(['message=>Invalid or expired invitation'],403);
        }

        $user=User::create(
            [
                'name'=>$data['name'],
                'password' => Hash::make($data['password']),  
                'email'=>$invitation->email,             
            ]
        );
        $invitation->update(['used' => true]);
        $token=JWTAuth::fromUser($user);
        return response()->json([
        'message' => 'User registered successfully.',
        'token' => $token,
        'user' => $user,
        ]);
    }
    public function login(LoginUserRequest $request){

        $credentials=$request->only('password','email');

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'message'=>'email or password is wrong',
            ],401);
        }

        $user=Auth::user();
        return response()->json([
        'message' => 'User login successfully.',
        'token' => $token,
        'user' => $user,
        ]);
    }
    public function logout(){
        JWTAuth::invalidate(JWTAuth::getToken());
         return response()->json(['message' => 'Logged out successfully.']);
    }
}
