<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\MainResource;
use App\Http\Resources\SemesterResource;
use App\Http\Resources\SemesterSingleResource;
use App\Models\Admin;
use App\Models\Children;
use App\Models\Semester;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SemesterController extends Controller
{
    //

    public function getAllSemester(Request $request){
        $semsters = Semester::where('status',true)->get();
        return new MainResource(SemesterResource::collection($semsters),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function getSingleSemester(Request $request,Semester $semester){
        return new MainResource(new SemesterSingleResource($semester),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }

    public function createSemester(Request $request){
        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'teacher_id' => 'required|numeric|exists:teachers,id',
        ]);

        if(!$validator->fails()){

            $semester = Semester::create([
                'name_ar' => $request->input('name_ar'),
                'name_en' => $request->input('name_en'),
                'teacher_id' => $request->input('teacher_id'),
            ]);
            
            $data = [
                'title' => __('dash.notfy_add_class_title'),
                'body' => __('dash.notfy_add_class_body') . App::isLocale('ar') ? $semester->name_ar : $semester->name_en
            ];
            // Send Notification only Admin has permission revers_notification
            $admins = Admin::all();
            foreach($admins as $a){
                if($a->hasPermissionTo('revers_notification')){
                    $a->notify(new AdminNotification($data));
                }
            }
            return new MainResource(new SemesterResource($semester),Response::HTTP_OK,ApiMsg::getMsg($request,'success_create'));
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);

        }
    }

    public function addChildToClass(Request $request, Semester $semester){
        $validator = Validator($request->all(),[
            'children_id' => 'required|string|exists:childrens,id',
        ]);

        if(!$validator->fails()){

            $children = Children::find($request->input('children_id'));
            $children->semester_id = $semester->id;
            $children->save();
            return new MainResource(new SemesterSingleResource($semester),Response::HTTP_OK,ApiMsg::getMsg($request,'success_add'));

        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

}
