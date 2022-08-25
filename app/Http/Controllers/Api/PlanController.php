<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\MainResource;
use App\Http\Resources\PlanResource;
use App\Http\Resources\SubscriptionResource;
use App\Models\Children;
use App\Models\Father;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{
    //

    public function getPlans(Request $request){
        $plans = Plan::where('active',true)->get();
        return new MainResource(PlanResource::collection($plans),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function subsPlan(Request $request , Plan $plan){
        $validator = validator($request->all(),[
            'father_id' => 'required|exists:fathers,id'
        ]);
        if(!$validator->fails()){
            $father = Father::find($request->input('father_id'));
            $father->plan_id = $plan->id;
            $father->save();
            $this->addAllChildrensSubs($father);
            return response()->json([
                'status' => true,
                'title' => ApiMsg::getMsg($request,'success')
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }


    /// This method add childrens auto , where num children eqaul plan total child subs
    public function addAllChildrensSubs(Father $father){
        // Delete All subs own [father id]
            Subscription::where('father_id',$father->id)->delete();
            $plan = $father->plan;
            $start = Carbon::now();
            $end = Carbon::now()->addMonths($plan->sum_month);
            $sumFatherSubs = Subscription::where('father_id',$father->id)->count();

            if($plan->totale_child_subscrip < $sumFatherSubs){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.num_subs_grt_plan') 
                ],Response::HTTP_BAD_REQUEST);
            }

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

}
