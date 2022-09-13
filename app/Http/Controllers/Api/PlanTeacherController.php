<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\MainResource;
use App\Http\Resources\PlanTeacherResource;
use App\Models\PlanTeacher;
use App\Models\SubscribtionTeacher;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlanTeacherController extends Controller
{
    //

    public function getPlans(Request $request){
        $plans = PlanTeacher::where('active',true)->get();
        return response()->json(
            new MainResource(PlanTeacherResource::collection($plans),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get')),
        Response::HTTP_OK);
    }


    public function checkExpired(Request $request){
        try{
           
            if(!Auth::guard('api-techer')->check()){
                return response()->json([
                    'status' => false,
                    'message' => ApiMsg::getMsg($request,'unauthorization')
                ],Response::HTTP_BAD_REQUEST);
            }
            $teacher = Teacher::find(auth()->user()->id);
            $isExpire = false;
            $subsTeacher = $teacher->subscribtionTeacher;
            $endDate = Carbon::parse($subsTeacher->end_subscrip_date);
            $now = Carbon::now();
                if($endDate <= $now){
                    $subs = SubscribtionTeacher::find($subsTeacher->id);
                    $subs->expire = Carbon::now();
                    $subs->save();
                    $isExpire = true;
                }
            if($isExpire){
                $teacher->plan_teacher_id = 1;
                $teacher->save();

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
