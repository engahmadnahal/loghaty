<?php

namespace App\Http\Controllers;

use App\Mail\PromotionSuccessEmail;
use App\Models\Father;
use App\Models\PromotionRequest;
use App\Models\SubscribtionTeacher;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class PromotionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('promotion.index',[
            'promotions' => PromotionRequest::all()
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
            'promotion_id' => 'required|numeric|exists:promotion_requests,id'
        ]);
        if(!$validator->fails()){
            $promotion = PromotionRequest::find($request->input('promotion_id'));
            $father = Father::find($promotion->father_id);
            $plan = $promotion->planTeacher; 

            $start = Carbon::now();
            $end = Carbon::now()->addMonths($plan->id != 1 ? $plan->sum_month : 24);

            $teacher = new Teacher;
            $subs = new SubscribtionTeacher;
            $teacher->fname = $promotion->fname;
            $teacher->lname = $promotion->lname;
            $teacher->national_id = $promotion->national_id;
            $teacher->mobile = $promotion->mobile;
            $teacher->email = $father->email;
            $teacher->password = $father->password;
            $teacher->country_id = $father->country_id;
            $teacher->status = 'active';
            $teacher->plan_teacher_id = $promotion->plan_teacher_id;
            $teacher->save();

            $promotion->delete();

            $subs->start_subscrip_date = $start;
            $subs->end_subscrip_date = $end;
            $subs->teacher_id = $teacher->id;

            $father->delete();
            $subs->save();

            Mail::to($teacher)->send(new PromotionSuccessEmail());

            return response()->json([
                'title'=>__('msg.success'),
                'message'=>__('msg.promotion_success')
            ],Response::HTTP_OK);



        }else{
            return response()->json([
                'title'=>__('msg.error'),
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PromotionRequest  $promotionRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionRequest $promotionRequest)
    {
        //
        return view('promotion.show',[
            'promotionRequest' => $promotionRequest
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PromotionRequest  $promotionRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotionRequest $promotionRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PromotionRequest  $promotionRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotionRequest $promotionRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PromotionRequest  $promotionRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotionRequest $promotionRequest)
    {
        //
        $isDelete = $promotionRequest->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
