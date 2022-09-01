<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Level;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Level::class,'level');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $levels = Level::all();
        return view('level.index',[
            'levels' => $levels
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
        return view('level.create');

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
            'points' => 'required|string',
            'orderd' => 'required|numeric|unique:levels',
            'active'=> 'required'
        ]);


        if(!$validator->fails()){
            $level = new Level;
            $level->name_en = $request->input('name_en');
            $level->name_ar = $request->input('name_ar');
            $level->points = $request->input('points');
            $level->orderd = $request->input('orderd');
            $level->active = $request->input('active') == "true" ? true : false;
            $level->save();

            // Data For Notification AdminNotification
            $data = [
                'title' => __('dash.notfy_add_level_title'),
                'body' => __('dash.notfy_add_level_body') . App::isLocale('ar') ? $level->name_ar : $level->name_en
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {

        
        return view('level.show',[
            'level' => $level,
            'histores' => $level->history
        ]);

        //
    }

    public function getAnlyt(Request $request , Level $level){
        $result = [];
        $count = 1;
        $histores = $level->history;
        if(!is_null($histores->first())){
            $temp = $histores->first()->created_at->format('Y-m-d');
            $histores->map(function($t) use(&$count,&$temp,&$result){
                $date = $t->created_at->format('Y-m-d');
                if($date == $temp){ 
                    $count++;
                }else{
                    $count = 1;
                }
                $temp = $date;
                if(!array_key_exists($date,$result)){
                    $result[$temp] = $count;
                }else{
                    $result[$temp] = $count;
                }
            });
    
            $anlyt = [];
            foreach($result As $k => $r){
                $data = [$k,$r];
                array_push($anlyt,$data);
            }
    
            return response()->json([
                'title' => __('msg.success'),
                'data' => $anlyt
            ]);
        }else{
            return response()->json([
                'title' => __('msg.success'),
                'data' => [[Carbon::now()->format('Y-m-d'),0]]
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        //
        return view('level.edit',[
            'level' => $level
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {

        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'points' => 'required|string',
            'orderd' => 'required|numeric|unique:levels,orderd,'.$level->orderd,
            'active'=> 'required'
        ]);


        if(!$validator->fails()){


            $level->name_en = $request->input('name_en');
            $level->name_ar = $request->input('name_ar');
            $level->points = $request->input('points');
            $level->orderd = $request->input('orderd');
            $level->active = $request->input('active') == "true" ? true : false;
            $level->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_create') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        //
        $isDelete = $level->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

        /**
     * Change the status user.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Level $level){
        if($level->active){
            $level->active = false;
        }else{
            $level->active = true;
        }
        $isSave = $level->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
