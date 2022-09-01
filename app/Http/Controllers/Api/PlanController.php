<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\ChildrenResource;
use App\Http\Resources\MainResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Children;
use App\Models\Father;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{
    public function getPlans(Request $request){
        $plans = Plan::where('active',true)->get();
        return new MainResource(PlanResource::collection($plans),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function subsPlan(Request $request , Plan $plan){
        $validator = validator($request->all(),[
            'father_id' => 'required|exists:fathers,id'
        ]);
        if(!$validator->fails()){
            // Send Request To method , Request own , information Card  
            $request->merge([
                'plan' => $plan
            ]);
            return (new PaymentController)->sendPaymentAndSubs($request);

        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /// Add Single Children to subs
    public function addChildrenToSubs(Request $request){
        $validator = validator($request->all(),[
            'father_id' => 'required|exists:fathers,id',
            'children_id' => 'required|exists:childrens,id',
        ]);

        if(!$validator->fails()){
            $checkSubsCild = Subscription::where('children_id',$request->input('children_id'))->first();
            
            if(is_null($checkSubsCild)){
                $father = Father::find($request->input('father_id'));
                $plan = $father->plan;
                $start = Carbon::now();
                $end = Carbon::now()->addMonths($plan->sum_month);
                $sumFatherSubs = Subscription::where('father_id',$father->id)->count();

                if($plan->totale_child_subscrip < $sumFatherSubs){
                    return response()->json([
                        'title'=>ApiMsg::getMsg($request,'error'),
                        'message'=>ApiMsg::getMsg($request,'num_subs_grt_plan'),
                    ],Response::HTTP_BAD_REQUEST);
                }

                $subs = new Subscription;
                $subs->father_id = $father->id;
                $subs->children_id = $request->input('children_id');
                $subs->start_subscrip_date = $start;
                $subs->end_subscrip_date = $end;
                $subs->save();

                return response()->json([
                    'status'=>true,
                    'title'=> ApiMsg::getMsg($request,'success'),
                    'message'=> ApiMsg::getMsg($request,'success_subs'),
                    'end_subs'=> $subs->end_subscrip_date->diffForHumans(),
                ],Response::HTTP_OK);

            }else{
               return response()->json([
                    'status'=>false,
                    'title'=> ApiMsg::getMsg($request,'success'),
                    'message'=> ApiMsg::getMsg($request,'already_added')
                ],Response::HTTP_OK);
            }

        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function getAllChildrenSubs(Request $request, Father $father){
        $allChild = Subscription::where('father_id',$father->id)->get();
        return new MainResource(SubscriptionResource::collection($allChild),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function getSingleChildrenSubs(Request $request, Children $children){
        $allChild = Subscription::where('children_id',$children->id)->get();
        return new MainResource(SubscriptionResource::collection($allChild),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function checkExpired(Request $request){
        try{
            $father = Father::find(auth()->user()->id);

            $isExpire = false;
            $subsChild = $father->subscriptions;
            foreach($subsChild as $c){
                $endDate = Carbon::parse($c->end_subscrip_date);
                $now = Carbon::now();
                if($endDate <= $now){
                    $subs = Subscription::find($c->id);
                    $subs->expire = Carbon::now();
                    $subs->save();
                    $isExpire = true;
                }
            }
            if($isExpire){
                $father->plan_id = 1;
                $father->save();

                return response()->json([
                    'status'=>true,
                    'message'=> ApiMsg::getMsg($request,'subs_expire'),
                ],Response::HTTP_OK);
            }
            
            return response()->json([
                'status'=>true,
                'message'=> ApiMsg::getMsg($request,'success_send'),
            ],Response::HTTP_OK);
            
        }catch(Exception $ex){
            return response()->json([
                'status'=>false,
                'message'=> ApiMsg::getMsg($request,'error'),
                'messages'=> $ex->getMessage(),
            ],Response::HTTP_BAD_REQUEST);
        }
    }


}
