<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Father;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class FatherController extends Controller
{

    public $plans;

    public function __construct()
    {
        $this->plans = Plan::where('active',true)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fathers = Father::with('subscriptions')->get();
        return view('father.index',[
            'fathers' => $fathers
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
        return view('father.create',[
            'plans' => $this->plans
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
            'email' => 'required|email|unique:fathers',
            'password' => 'required|string|min:6|max:12',
            'plan_id' => 'required|numeric|exists:plans,id',
            'active'=> 'required'
        ]);


        if(!$validator->fails()){


            $father = new Father;
            $father->email = $request->input('email');
            $father->password = $request->input('password');
            $father->plan_id = $request->input('plan_id');
            $father->status = $request->input('active') == "true" ? 'active' : 'block';
            $father->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_create') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function show(Father $father)
    {
        //
        $childrens = Children::where('father_id',$father->id)->get();
        $subsChildrens = Children::whereHas('subscriptions',function($q) use($father){
            $q->where('father_id',$father->id);
        })->get();
        return view('father.show',[
            'father' =>$father,
            'childrens' => $childrens,
            'subsChildrens' => $subsChildrens
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function edit(Father $father)
    {
        //
        return view('father.edit',[
            'father' =>$father,
            'plans' => $this->plans,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Father $father)
    {
        //
        $validator = Validator($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:12',
            'plan_id' => 'required|numeric|exists:plans,id',
            'active'=> 'required'
        ]);

        if(!$validator->fails()){


            $father->email = $request->input('email');
            $father->password = $request->input('password');
            $father->plan_id = $request->input('plan_id');
            $father->status = $request->input('active') == "true" ? 'active' : 'block';
            $father->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_edit') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function destroy(Father $father)
    {
        //
        $isDelete = $father->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Change the status user.
     *
     * @param  \App\Models\Father  $teacher
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Father $father){
        if($father->status == 'active'){
            $father->status = 'block';
        }else{
            $father->status = 'active';
        }
        $isSave = $father->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
