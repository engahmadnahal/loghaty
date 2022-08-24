<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Plan::class,'plan');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plan::all();
        return view('plan.index',[
            'plans' => $plans
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
        return view('plan.create');

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
            'name_en' => 'required|string|min:4|max:12',
            'name_ar' => 'required|string|min:4|max:12',
            'sum_month'=> 'required|string',
            'price_usd'=> 'required|string',
            'price_aed'=> 'required|string',
            'totale_child_subscrip'=> 'required|string',
            'active'=> 'required',
        ]);

        if(!$validator->fails()){

            $plan = new Plan;
            $plan->name_en = $request->input('name_en');
            $plan->name_ar = $request->input('name_ar');
            $plan->sum_month = intval($request->input('sum_month'));
            $plan->price_usd = doubleval($request->input('price_usd'));
            $plan->price_aed = doubleval($request->input('price_aed'));
            $plan->totale_child_subscrip = intval($request->input('totale_child_subscrip'));
            $plan->active = $request->input('active') == "true" ? true : false;
            $isSave = $plan->save();
            
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
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
        $childrens = Children::whereHas('father',function($q) use($plan){
            $q->where('plan_id',$plan->id);
        })->get();
        return view('plan.show',[
            'plan'=>$plan,
            'childrens' => $childrens
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
        return view('plan.edit',[
            'plan'=>$plan
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $validator = Validator($request->all(),[
            'name_en' => 'required|string|min:4|max:12',
            'name_ar' => 'required|string|min:4|max:12',
            'sum_month'=> 'required|string',
            'price_usd'=> 'required|string',
            'price_aed'=> 'required|string',
            'totale_child_subscrip'=> 'required|string',
            'active'=> 'required',
        ]);

        if(!$validator->fails()){

            $plan->name_en = $request->input('name_en');
            $plan->name_ar = $request->input('name_ar');
            $plan->sum_month = intval($request->input('sum_month'));
            $plan->price_usd = doubleval($request->input('price_usd'));
            $plan->price_aed = doubleval($request->input('price_aed'));
            $plan->totale_child_subscrip = intval($request->input('totale_child_subscrip'));
            $plan->active = $request->input('active') == "true" ? true : false;
            $isSave = $plan->save();
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
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
        $isDelete = $plan->delete();
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
    public function changeStatus(Plan $plan){
        if($plan->active){
            $plan->active = false;
        }else{
            $plan->active = true;
        }
        $isSave = $plan->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
