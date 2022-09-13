<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Models\Admin;
use App\Models\Father;
use App\Models\PlanTeacher;
use App\Models\PromotionRequest;
use App\Notifications\AdminNotification;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class PromotionRequsetController extends Controller
{
    //
    public function sendPromotion(Request $request)   
    {
        $validator = Validator($request->all(),[
            'card_name' => 'required|string',
            'card_expire' => 'required|string|max:5',
            'card_num' => 'required|string|min:16|max:16',
            'card_cvv' => 'required|string|min:3|max:4',
            'country' => 'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mobile' => 'required|string|unique:teachers,mobile',
            'national_id' => 'required|string|unique:teachers,national_id',
            'plan_id' =>'required|string|exists:plan_teachers,id',
            'notes' => 'required|string'
        ]);

        if(!$validator->fails()){

            $promotion = new PromotionRequest;
            $promotion->fname = $request->input('fname');
            $promotion->lname = $request->input('lname');
            $promotion->mobile = $request->input('mobile');
            $promotion->national_id = $request->input('national_id');
            $promotion->father_id = auth()->user()->id;
            $promotion->plan_teacher_id = $request->input('plan_id');
            $promotion->notes = $request->input('notes');
            $promotion->save();

            // send mony
            return $this->checkout($request);
            
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }


    }

    public function checkout(Request $request){
        try{
            $father = Father::find(auth()->user()->id);
            $stripe = Stripe::make(env('STRIPE_KEY'));

            // create token for cridt card
            $expirCard = explode('/',$request->input('card_expire'));
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->input('card_num'),
                    'exp_month' => $expirCard[0],
                    'exp_year' => $expirCard[1],
                    'cvc' => $request->input('card_cvv')
                ],
            ]);
            

            // init info user
            $customer = $stripe->customers()->create([
                'name' => substr($father->email,0,strpos($father->email,'@')),
                'email' => $father->email,
                'source' => $token['id'],
            ]);
            
            $plan = PlanTeacher::find($request->input('plan_id'));
            // init setting pay
            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => $this->getTypeMoney($request->input('country')),
                'amount'   => $this->getTypeMoneyCode($plan,$request->input('country')),
            ]);
            
            // Check status payament
            if($charge['status'] == 'succeeded'){
                // $this->changePlanFather($request->plan,$father);

                $data = [
                    'title' => __('dash.new_subs_title'),
                    'body' =>  App::isLocale('ar') ? $plan->name_ar : $plan->name_en
                ];
                // Send Notification only Admin has permission revers_notification
                $admins = Admin::all();
                foreach($admins as $a){
                    if($a->hasPermissionTo('revers_notification')){
                        $a->notify(new AdminNotification($data));
                    }
                }
                // if status success
                return response()->json([
                    'status'=>true,
                    'title'=> ApiMsg::getMsg($request,'success'),
                    'message'=> ApiMsg::getMsg($request,'promotion_success')
                ],Response::HTTP_OK);

            }else{
                // if faild status
                return response()->json([
                    'status'=>false,
                    'title'=> ApiMsg::getMsg($request,'error'),
                    'message'=> ApiMsg::getMsg($request,'error_payment_faild')
                ],Response::HTTP_BAD_REQUEST);
            }
        }catch(Exception $ex){
            // if any Exception
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $ex->getMessage()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    // Get Type Money Used Paying
    public function getTypeMoney($country){
        if($country == 'UEA' || $country == 'uea'){
            return 'AED';
        }
        return "USD";
    }

    public function getTypeMoneyCode(PlanTeacher $planTeacher,$country){

        if($country == 'UEA' || $country == 'uea'){
            return $planTeacher->price_aed;
        }
        return $planTeacher->price_usd;
    }
}
