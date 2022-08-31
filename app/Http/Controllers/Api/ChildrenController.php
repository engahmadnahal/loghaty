<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ChildrenResource;
use App\Http\Resources\ChildrenSingleResource;
use App\Http\Resources\MainResource;
use App\Http\Resources\ProgressResource;
use App\Http\Trait\CustomTrait;
use App\Models\Activity;
use App\Models\Admin;
use App\Models\Children;
use App\Models\History;
use App\Models\Progress;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ChildrenController extends Controller
{
    use CustomTrait;
    //

    public function getAllChildren(Request $request){
        $childrens = Children::where('status','active')->where('father_id',auth()->user()->id)->get();
        return new MainResource(ChildrenResource::collection($childrens),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function getSingleChildren(Request $request,Children $children){
        return new MainResource(new ChildrenSingleResource($children),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function deleteChildren(Request $request,Children $children){
        $children->delete();
        return response()->json(
            [
                'status'=>true,
                'message' =>ApiMsg::getMsg($request,'success_delete'),
            ],Response::HTTP_OK
        );
    }

    public function addChildren(Request $request){
        $validator = Validator($request->all(),[
            'name' => 'required|string',
            'dob' => 'required|string',
            'country_id' => 'required|numeric|exists:countries,id',
            'class_id' => 'required|numeric|exists:semesters,id',
            'image_avater' => 'required|image|mimes:jpg,png,jpeg,gif',
        ]);

        if(!$validator->fails()){

            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
            }

            $children = Children::create([
                'name' => $request->input('name'),
                'date_of_birth' => $request->input('dob'),
                'country_id' => $request->input('country_id'),
                'father_id' => auth()->user()->id,
                'semester_id' => $request->input('class_id'),
                'avater' => $filePath
            ]);


            // Data For Notification AdminNotification
            $data = [
                'title' => __('dash.notfy_add_children_title'),
                'body' => __('dash.notfy_add_children_body').' ' . $children->name
            ];
            // Send Notification only Admin has permission revers_notification
            $admins = Admin::all();
            foreach($admins as $a){
                if($a->hasPermissionTo('revers_notification')){
                    $a->notify(new AdminNotification($data));
                }
            }

            return new MainResource(new ChildrenSingleResource($children),Response::HTTP_OK,ApiMsg::getMsg($request,'success_create'));
        }else{
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    public function sendProgress(Request $request, Children $children){
        $validator = Validator($request->all(),[
            'level_id' => 'required|numeric|exists:levels,id',
            'points' => 'required|string',
        ]);
        if(!$validator->fails()){
            $prog = new Progress;
            $prog->children_id = $children->id;
            $prog->level_id = $request->input('level_id');
            $prog->points = $request->input('points');
            $prog->save();
            return response()->json(['status'=>true,'title'=>ApiMsg::getMsg($request,'success'),'message'=>ApiMsg::getMsg($request,'success_create')],Response::HTTP_OK);
        }else{
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    public function getProgress(Request $request, Children $children){
        

            $prog = Progress::where('children_id',$children->id)->get();
            $progSingle = Progress::where('children_id',$children->id)->first();

            if(($prog->count() > 0) || !is_null($progSingle)){
                $totalPoints = 0;
                foreach($prog as $p){
                    $totalPoints += $p->points;
                }
                $progSingle->setAttribute('totalpoints',$totalPoints);
                return new MainResource(new ProgressResource($progSingle),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
            }

            return response()->json(['status'=>false,'message'=>ApiMsg::getMsg($request,'not_result')],Response::HTTP_BAD_REQUEST);

            
    }

    public function sendDateLastVist(Request $request,Children $children){
        //last_vist sum_day
        if( 
            Carbon::parse($children->last_vist)->format('Y-m-d') == Carbon::today()->addDay(-1)->format('Y-m-d')
        ){
            $children->sum_day = $children->sum_day + 1;
        }

        if(intval($children->sum_day) % 5){
            $activitie = new Activity;
            $activitie->title_en = 'Congratulations';
            $activitie->title_ar = 'تهاينا';
            $activitie->body_ar = 'لقد انجزت '.$children->sum_day.' ايام تعلم';
            $activitie->body_en = 'You have completed '.$children->sum_day.' days of learning';
        }

        $children->last_vist = Carbon::now();
        $children->save();

        return response()->json(['status'=>true,'title'=>ApiMsg::getMsg($request,'success'),'message'=>ApiMsg::getMsg($request,'success_send')],Response::HTTP_OK);

    }

    public function getCertificates(Request $request, Children $children){


            $activities = $children->activities;
            return new MainResource(ActivityResource::collection($activities),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function sendHistory(Request $request, Children $children){
        $validator = Validator($request->all(),[
            'level_id' => 'required|numeric|exists:levels,id',
            'game_id' => 'required|numeric|exists:games,id'
        ]);

        if(!$validator->fails()){
            $history = new History;
            $history->level_id = $request->input('level_id');
            $history->game_id = $request->input('game_id');
            $history->children_id = $children->id;
            $history->save();
            return response()->json(['status'=>true,'title'=>ApiMsg::getMsg($request,'success'),'message'=>ApiMsg::getMsg($request,'success_create')],Response::HTTP_OK);
        }else{
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
}
