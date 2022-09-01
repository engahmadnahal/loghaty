<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Models\Admin;
use App\Models\Father;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscription;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
            'country' => 'required|string',
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
            $father = Father::find($request->input('father_id'));
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
            
            // init setting pay
            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => $this->getTypeMoney($request->input('country')),
                'amount'   => $this->getTypeMoneyCode($request->plan,$request->input('country')),
            ]);
            
            // Check status payament
            if($charge['status'] == 'succeeded'){
                $this->changePlanFather($request->plan,$father);

                $data = [
                    'title' => __('dash.new_subs_title'),
                    'body' =>  App::isLocale('ar') ? $request->plan->name_ar : $request->plan->name_en
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
                    'message'=> ApiMsg::getMsg($request,'success_payment')
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

    public function getTypeMoneyCode(Plan $plan,$country){

        if($country == 'UEA' || $country == 'uea'){
            return $plan->price_aed;
        }
        return $plan->price_usd;
    }




    public function changePlanFather(Plan $plan,Father $father){
        // Start Change Plan if pyment Success
        $father->plan_id = $plan->id;
        $father->save();
        // End Change Plan if pyment Success

        // Add All Children refernsese father
        $this->addAllChildrensSubs($father);
    }

    // This method add childrens auto , where num children eqaul plan total child subs
    public function addAllChildrensSubs(Father $father){
        // Delete All subs own [father id]
        Subscription::where('father_id',$father->id)->delete();
        $plan = $father->plan;
        $start = Carbon::now();
        $end = Carbon::now()->addMonths($plan->sum_month);
        $sumFatherSubs = Subscription::where('father_id',$father->id)->count();
    
    
        $count = 1;
        foreach($father->childrens as $c){
            if($count > $plan->totale_child_subscrip){
                return;
            }
            $subs = new Subscription;
            $subs->father_id = $father->id;
            $subs->children_id = $c->id;
            $subs->start_subscrip_date = $start;
            $subs->end_subscrip_date = $end;
            $subs->save();
            $count++;
        }
    }

}
