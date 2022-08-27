<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Children;
use App\Models\Classe;
use App\Models\Country;
use App\Models\Father;
use App\Models\Semester;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChildrenController extends Controller
{
    use CustomTrait;


    public $fathers;
    public $childrenes;
    public $countres;

    public function __construct()
    {
        $this->authorizeResource(Children::class,'children');

        $this->fathers = Father::where('status','active')->get();
        $this->classes = Semester::where('status','active')->get();
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
        return view('children.index',[
            'childrens' => Children::all()
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

        return view('children.create',[
            'fathers' => $this->fathers,
            'classes' => $this->classes,
            'countres' => $this->countres,
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
            'name' => 'required|string',
            'dob' => 'required|string',
            'country_id' => 'required|numeric|exists:countries,id',
            'father_id' => 'required|numeric|exists:fathers,id',
            'class_id' => 'required|numeric|exists:classes,id',
            'image_avater' => 'required|image|mimes:jpg,png,jpeg,gif',
            'active'=> 'required'
            
        ]);

        if(!$validator->fails()){

            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
            }

            $children = new Children;
            $children->name = $request->input('name');
            $children->date_of_birth = $request->input('dob');
            $children->country_id = $request->input('country_id');
            $children->father_id = $request->input('father_id');
            $children->semester_id = $request->input('class_id');
            $children->avater = $filePath;
            $children->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $children->save();
            

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
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function show(Children $children)
    {

        return view('children.show',[
            'children' => $children,
            
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function edit(Children $children)
    {
        return view('children.edit',[
            'children' => $children,
            'fathers' => $this->fathers,
            'classes' => $this->classes,
            'countres' => $this->countres,
        ]);

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Children $children)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string',
            'dob' => 'required|string',
            'country_id' => 'required|numeric|exists:countries,id',
            'father_id' => 'required|numeric|exists:fathers,id',
            'class_id' => 'required|numeric|exists:classes,id',
            $this->getImageValidate($request->hasFile('image_avater'))['image_avater'],
            'active'=> 'required'
            
        ]);

        if(!$validator->fails()){

            $children->name = $request->input('name');
            $children->date_of_birth = $request->input('dob');
            $children->country_id = $request->input('country_id');
            $children->father_id = $request->input('father_id');
            $children->semester_id = $request->input('class_id');
            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
                $children->avater = $filePath;
            }
            $children->status = $request->input('active') == "true" ? 'active' : 'block';
            $isSave = $children->save();
            
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
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function destroy(Children $children)
    {

        $isDelete = $children->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        //
    }


    /**
     * Change the status user.
     *
     * @param  \App\Models\Children  $teacher
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Children $children){
        if($children->status == 'active'){
            $children->status = 'block';
        }else{
            $children->status = 'active';
        }
        $isSave = $children->save();
        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
