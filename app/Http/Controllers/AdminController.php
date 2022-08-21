<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    use CustomTrait;

    private $countres;

    public function __construct()
    {
        $this->countres = Country::where('active',true)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin.index',[
            'admins' => $admins,
            'countres' => $this->countres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.create',[
            'countres' => $this->countres
        ]);
        //
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
            'full_name' => 'required|string',
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

            $newAdmin = new Admin;
            $newAdmin->name = $request->input('full_name');
            $newAdmin->email = $request->input('email');
            $newAdmin->password = Hash::make($request->input('password'));
            $newAdmin->country_id = $request->input('country');
            $newAdmin->status = $request->input('active') == "true" ? 'active' : 'block';
            $newAdmin->avater = $filePath;
            $isSave = $newAdmin->save();
            
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //

        return view('admin.show',[
            'admin' =>$admin,
            'countres' => $this->countres
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    // public function edit(Admin $admin)
    // {
    //     //
    //     $countres = Country::where('active',true)->get();
    //     return view('admin.edit',[
    //         'admin' =>$admin,
    //         'countres' => $countres
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(),[
            'full_name' => 'required|string',
            'country' => 'required|numeric|exists:countries,id',
            'email' => 'required|email',
            $this->getImageValidate($request->hasFile('image_avater'))['image_avater']
            
        ]);

        if(!$validator->fails()){

            $admin->name = $request->input('full_name');
            $admin->email = $request->input('email');
            $admin->country_id = $request->input('country');
            if($request->hasFile('image_avater')){
                $filePath = $this->uploadFile($request->file('image_avater'));
                $admin->avater = $filePath;
            }
            $isSave = $admin->save();
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_edit') :  __('msg.error_edit')
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDelete = $admin->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    /**
     * Change the status user.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */

    public function changeStatus(Admin $admin){
        if($admin->status == 'active'){
            $admin->status = 'block';
        }else{
            $admin->status = 'active';
        }
        $isSave = $admin->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }



  
}
