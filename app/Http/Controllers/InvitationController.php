<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Mail\InvitationMail;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function invite(InvitationRequest $request){

        $token=Str::uuid()->toString();
        Invitation::create([
            'email'=>$request->email,
            'token'=>$token,
            'user_id'=>Auth::id(),
        ]);
        $inviteLink=url('api/users/register?token='.$token);

        Mail::to($request->email)->send(new InvitationMail($inviteLink));

         return response()->json([
        'message' => 'Invitation sent to ' . $request->email . 'successfully',
        'token'=>$token,
    ], 201);
    }
}
