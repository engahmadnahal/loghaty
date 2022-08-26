<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Children;
use App\Models\Semester;
use App\Models\Teacher;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SemesterController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Semester::class,'semester');
        // dd($this->getMiddleware());

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('class.index',[
            'classes' => Semester::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('class.create',[
            'teachers' => Teacher::where('status','active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'teacher_id' => 'required|numeric|exists:teachers,id',
            'active'=> 'required'
            
        ]);

        if(!$validator->fails()){

            $semester = new Semester;
            $semester->name_en = $request->input('name_en');
            $semester->name_ar = $request->input('name_ar');
            $semester->teacher_id = $request->input('teacher_id');
            $semester->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $semester->save();
            
            $data = [
                'title' => __('dash.notfy_add_class_title'),
                'body' => __('dash.notfy_add_class_body') . App::isLocal('ar') ? $semester->name_ar : $semester->name_en
            ];
            // Send Notification only Admin has permission revers_notification
            $admins = Admin::all();
            foreach($admins as $a){
                if($a->hasPermissionTo('revers_notification')){
                    $a->notify(new AdminNotification($data));
                }
            }
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
        $latestChild = Children::whereHas('semester',function($q){
            $q->where('status','active');
                
        })->where('semester_id',$semester->id)->orderBy('created_at','desc')->get();
        return view('class.show',[
            'class' => $semester,
            'latestChild' => $latestChild
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
        return view('class.edit',[
            'class' => $semester,
            'teachers' => Teacher::where('status','active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        //
        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'teacher_id' => 'required|numeric|exists:teachers,id',
            'active'=> 'required'
            
        ]);

        if(!$validator->fails()){
            
            $semester->name_en = $request->input('name_en');
            $semester->name_ar = $request->input('name_ar');
            $semester->teacher_id = $request->input('teacher_id');
            $semester->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $semester->save();
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_edit') :  __('msg.error_edit')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        //
        $isDelete = $semester->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        //
    }


    /**
     * Change the status user.
     *
     * @param  \App\Models\Semester  $teacher
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Semester $semester){
        if($semester->status == 'active'){
            $semester->status = 'block';
        }else{
            $semester->status = 'active';
        }
        $isSave = $semester->save();
        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
