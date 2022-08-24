<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Children;
use App\Models\Classe;
use App\Models\Country;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    use CustomTrait;

    private $countres;

    public function __construct()
    {
        $this->authorizeResource(Teacher::class,'teacher');
        $this->countres = Country::where('active',true)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        return view('teacher.index',[
            'teachers' => $teachers
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
        
        return view('teacher.create',[
            'countres' =>$this->countres 
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
        $validator = Validator($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'national_id' => 'required|string',
            'mobile' => 'required|string',
            'country' => 'required|numeric|exists:countries,id',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6|max:12',
            'image_avater' => 'required|image|mimes:jpg,png,jpeg,gif',
            'active'=> 'required'
        ]);

        if(!$validator->fails()){

            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
            }

            $teacher = new Teacher;
            $teacher->fname = $request->input('fname');
            $teacher->lname = $request->input('lname');
            $teacher->national_id = $request->input('national_id');
            $teacher->mobile = $request->input('mobile');
            $teacher->email = $request->input('email');
            $teacher->password = Hash::make($request->input('password'));
            $teacher->country_id = $request->input('country');
            $teacher->status = $request->input('active') == "true" ? 'active' : 'block';
            $teacher->avater = $filePath;
            $isSave = $teacher->save();
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_edit') :  __('msg.error_edit')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
        $childrens = Children::where('status','active')->take(5)->get();
        $classes = Classe::whereHas('teacher',function($q){
            $q->where('status','active');
        })->get();
        return view('teacher.show',[
            'teacher' =>$teacher,
            'childrens' => $childrens,
            'classes' => $classes
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        return view('teacher.edit',[
            'teacher' => $teacher,
            'countres' =>$this->countres 

        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $validator = Validator($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'national_id' => 'required|string',
            'mobile' => 'required|string',
            'country' => 'required|numeric|exists:countries,id',
            'email' => 'required|email|unique:admins',
            'active'=> 'required',
            $this->getImageValidate($request->hasFile('image_avater'))['image_avater']
        ]);

        if(!$validator->fails()){

            $teacher->fname = $request->input('fname');
            $teacher->lname = $request->input('lname');
            $teacher->national_id = $request->input('national_id');
            $teacher->mobile = $request->input('mobile');
            $teacher->email = $request->input('email');
            $teacher->country_id = $request->input('country');
            $teacher->status = $request->input('active') == "true" ? 'active' : 'block';
            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
                $teacher->avater = $filePath;

            }
            $isSave = $teacher->save();
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    public function getImageValidate($bool){
        if($bool){
            return ['image_avater' => 'nullable|image|mimes:jpg,png,jpeg,gif'];
        }
        return ['image_avater' => 'nullable'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        $isDelete = $teacher->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    /**
     * Change the status user.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Teacher $teacher){
        if($teacher->status == 'active'){
            $teacher->status = 'block';
        }else{
            $teacher->status = 'active';
        }
        $isSave = $teacher->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
