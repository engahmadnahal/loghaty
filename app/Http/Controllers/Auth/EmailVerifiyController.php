<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifiyController extends Controller
{
    //

    public function showVerifiyEmail(){
        return view('auth.verify');
    }

    public function sendVerifiyEmail(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'title' => __('msg.success'),
            'message'=> __('msg.check_email')
        ],Response::HTTP_OK);
    }

    public function verifiyEmail(EmailVerificationRequest $emailVerificationRequest){
        $emailVerificationRequest->fulfill();
        return redirect()->route('home.index');
    }

}
