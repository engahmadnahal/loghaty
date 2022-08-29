<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Models\Payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    //

    public function sendPaymentAndSubs(Request $request){
        $validator = Validator($request->all(),[
            'card_name' => 'required|string',
            'card_expire' => 'required|string|max:5',
            'card_num' => 'required|string|min:16|max:16',
            'card_cvv' => 'required|string|min:3|max:4',
        ]);

        if(!$validator->fails()){
            Payment::where('father_id',$request->input('father_id'))->delete();
            $payment = new Payment;
            $payment->father_id = $request->input('father_id');
            $payment->card_name = $request->input('card_name');
            $payment->card_expire = $request->input('card_expire');
            $payment->card_num = $request->input('card_num');
            $payment->card_cvv = $request->input('card_cvv');
            $payment->save();
            return response()->json(['status'=>true,'title'=>ApiMsg::getMsg($request,'success'),'message'=>ApiMsg::getMsg($request,'success_create')],Response::HTTP_OK);
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }
}
