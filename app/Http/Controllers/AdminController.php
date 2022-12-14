<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Mail\AdminInfoMail;
use App\Models\Admin;
use App\Models\Country;
use App\Models\GroupPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    use CustomTrait;

    private $countres;

    public function __construct()
    {
        $this->authorizeResource(Admin::class,'admin');
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
            Mail::to($newAdmin->email)->send(new AdminInfoMail($newAdmin,$request->input('password')));
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
            return ['image_avater' => 'required|image|mimes:jpg,png,jpeg,gif'];
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



    public function editUserPermission(Request $request , Admin $admin){
        $permissions = Permission::where('guard_name','admin')->get();
        $adminPermissions = $admin->permissions;
        if(count($adminPermissions) > 0){
            foreach($permissions as $permission){
                $permission->setAttribute('assign',false);
                foreach($adminPermissions as $empPermission){
                    if($empPermission->id == $permission->id){
                        $permission->setAttribute('assign',true);
                    }
                }
            }
        }
        return view('admin.permission',['admin'=>$admin,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateUserPermission(Request $request , Admin $admin ){

        $validator = Validator($request->all(),[
            'permission_id' =>'required|exists:permissions,id'
        ]);

        if(!$validator->fails()){
            $permission = Permission::findOrFail($request->input('permission_id'));
            if($admin->hasPermissionTo($permission)){
                $admin->revokePermissionTo($permission);
            }else{
                $admin->givePermissionTo($permission);
            }
            return response()->json([
                'title' => __('msg.success'),
            'message' => __('msg.giv_permission')
            ],Response::HTTP_OK);
        }else{
        return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }


    public function showNotification(){

        return view('admin.notification');
    }

    public function readNotification(){
        auth()->user()->unreadNotifications->markAsRead();
    }

 

    /// This Methods For Coustom Add Method to Policy
    public function resourceAbilityMap(){
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'showNotification'=>'showNotification'
        ];
    }

    /**
     * Get the list of resource methods which do not have model parameters.
     *
     * @return array
     */
    protected function resourceMethodsWithoutModels()
    {
        return ['index', 'create', 'store','showNotification'];
    }

  
}
