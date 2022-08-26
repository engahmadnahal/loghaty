<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Children;
use App\Models\Classe;
use App\Models\Teacher;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SemesterControllerClasseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Semester::class,'classe');
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
            'classes' => Classe::all()
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

            $class = new Classe;
            $class->name_en = $request->input('name_en');
            $class->name_ar = $request->input('name_ar');
            $class->teacher_id = $request->input('teacher_id');
            $class->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $class->save();
            
            $data = [
                'title' => __('dash.notfy_add_class_title'),
                'body' => __('dash.notfy_add_class_body') . App::isLocal('ar') ? $class->name_ar : $class->name_en
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
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        //
        $latestChild = Children::whereHas('classe',function($q){
            $q->where('status','active');
                
        })->orderBy('created_at','desc')->get();
        return view('class.show',[
            'classe' => $classe,
            'latestChild' => $latestChild
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(Classe $class)
    {
        //
        return view('class.edit',[
            'class' => $class,
            'teachers' => Teacher::where('status','active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $class)
    {
        //
        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'teacher_id' => 'required|numeric|exists:teachers,id',
            'active'=> 'required'
            
        ]);

        if(!$validator->fails()){
            
            $class->name_en = $request->input('name_en');
            $class->name_ar = $request->input('name_ar');
            $class->teacher_id = $request->input('teacher_id');
            $class->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $class->save();
            
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
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $class)
    {
        //
        $isDelete = $class->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        //
    }


    /**
     * Change the status user.
     *
     * @param  \App\Models\Classe  $teacher
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Classe $class){
        if($class->status == 'active'){
            $class->status = 'block';
        }else{
            $class->status = 'active';
        }
        $isSave = $class->save();
        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


}
