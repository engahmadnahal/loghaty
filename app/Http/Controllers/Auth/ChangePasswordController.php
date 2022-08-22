<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    //
    public function changePassword(Request $request){
        $validator = Validator($request->all(),[
            'old_password'=>'required|string|min:6|max:12',
            'new_password'=>'required|confirmed|min:6|max:12',
        ]);

        if(!$validator->fails()){
            
            if(!Hash::check($request->input('old_password'),auth()->user()->password)){
                return response()->json([
                    'title'=>__('msg.error'),
                    'message'=>__('dash.old_password_error')
                ],Response::HTTP_BAD_REQUEST);
            }

            Admin::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->input('new_password'))
            ]);
            return response()->json([
                'title'=>__('msg.success'),
                'message'=>__('dash.success_change')
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'title'=>__('msg.error'),
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
