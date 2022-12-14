<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Children;
use App\Models\Father;
use App\Models\Plan;
use App\Models\Subscription;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Subscription::class,'subscription');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subscriptions = Subscription::all();
        return view('subscrip.index',[
            'subscriptions' => $subscriptions
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $fathers = Father::where('status','active')->get();
        return view('subscrip.create',[
            'fathers' => $fathers,
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
            'father_id' => 'required|string|exists:fathers,id',
            'children_id' =>'required|string|exists:childrens,id',
        ]);


        if(!$validator->fails()){


            $father = Father::find($request->input('father_id'));
            $plan = $father->plan;
            $start = Carbon::now();
            $end = Carbon::now()->addMonths($plan->id != 1 ? $plan->sum_month : 24);
            $sumFatherSubs = Subscription::where('father_id',$request->input('father_id'))->count();

            if($plan->totale_child_subscrip < $sumFatherSubs){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.num_subs_grt_plan') 
                ],Response::HTTP_BAD_REQUEST);
            }
            $subs = new Subscription;
            $subs->father_id = $request->input('father_id');
            $subs->children_id = $request->input('children_id');
            $subs->start_subscrip_date = $start;
            $subs->end_subscrip_date = $end;
            $subs->save();

            $data = [
                'title' => __('dash.notfy_subs_game_title'),
                'body' => __('dash.notfy_subs_game_body')
            ];
            // Send Notification only Admin has permission revers_notification
            $admins = Admin::all();
            foreach($admins as $a){
                if($a->hasPermissionTo('revers_notification')){
                    $a->notify(new AdminNotification($data));
                }
            }

            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_create') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }

    }

  

    


    public function changeSubs(Request $request)
    {
        //
        $validator = Validator($request->all(),[
            'father_id' => 'required|string|exists:fathers,id',
            'children_id' =>'required|string|exists:childrens,id',
        ]);


        if(!$validator->fails()){
            $subscription = Subscription::where('children_id',$request->input('children_id'))->first();
            $subscription->delete();

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
        $isDelete = $subscription->delete();
    }

    public function getChildrens(Request $request){
        $validator = Validator($request->all(),[
            'father_id' => 'required|string|exists:fathers,id'
        ]);

        if(!$validator->fails()){
            $childrens = Children::where('father_id',$request->input('father_id'))->get();
            $subs = Subscription::where('father_id',$request->input('father_id'))->get();

            foreach($childrens as $c){
                $c->setAttribute('subscrip',false);
                foreach($subs as $s){
                    if($c->id == $s->children_id){
                        $c->setAttribute('subscrip',true);
                    }else{
                    }
                }
            }

            return response()->json([
                'childrens'=>$childrens,
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'title'=>__('msg.error'),
                'message' => __('msg.error_get')
            ],Response::HTTP_OK);
        }
    }
}
