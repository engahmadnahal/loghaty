<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Plan;
use App\Models\PlanTeacher;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class PlanTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('planteacher.index',[
            'plans' => PlanTeacher::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('planteacher.create');
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
            'name_en' => 'required|string|min:4',
            'name_ar' => 'required|string|min:4',
            'sum_month'=> 'required|string',
            'price_usd'=> 'required|string',
            'price_aed'=> 'required|string',
            'max_class'=> 'required|string',
            'max_children'=> 'required|string',
            'active'=> 'required',
        ]);

        if(!$validator->fails()){

            $planTeacher = new PlanTeacher;
            $planTeacher->name_en = $request->input('name_en');
            $planTeacher->name_ar = $request->input('name_ar');
            $planTeacher->sum_month = intval($request->input('sum_month'));
            $planTeacher->price_usd = doubleval($request->input('price_usd'));
            $planTeacher->price_aed = doubleval($request->input('price_aed'));
            $planTeacher->max_class = intval($request->input('max_class'));
            $planTeacher->max_children = intval($request->input('max_children'));
            $planTeacher->active = $request->input('active') == "true" ? true : false;
            $isSave = $planTeacher->save();

            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanTeacher  $planTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanTeacher $planTeacher)
    {
        //
        return view('planteacher.edit',[
            'plan' => $planTeacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanTeacher  $planTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanTeacher $planTeacher)
    {
        //
        $validator = Validator($request->all(),[
            'name_en' => 'required|string|min:4',
            'name_ar' => 'required|string|min:4',
            'sum_month'=> 'required|string',
            'price_usd'=> 'required|string',
            'price_aed'=> 'required|string',
            'max_class'=> 'required|string',
            'max_children'=> 'required|string',
            'active'=> 'required',
        ]);

        if(!$validator->fails()){

            $planTeacher->name_en = $request->input('name_en');
            $planTeacher->name_ar = $request->input('name_ar');
            $planTeacher->sum_month = intval($request->input('sum_month'));
            $planTeacher->price_usd = doubleval($request->input('price_usd'));
            $planTeacher->price_aed = doubleval($request->input('price_aed'));
            $planTeacher->max_class = intval($request->input('max_class'));
            $planTeacher->max_children = intval($request->input('max_children'));
            $planTeacher->active = $request->input('active') == "true" ? true : false;
            $isSave = $planTeacher->save();

            
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanTeacher  $planTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanTeacher $planTeacher)
    {
        $isDelete = $planTeacher->delete();
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
    public function changeStatus(PlanTeacher $planTeacher){
        if($planTeacher->active){
            $planTeacher->active = false;
        }else{
            $planTeacher->active = true;
        }
        $isSave = $planTeacher->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
