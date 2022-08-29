<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Game;
use App\Models\Level;
use App\Models\Plan;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    use CustomTrait;

    public function __construct()
    {
        $this->authorizeResource(Game::class,'game');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $games = Game::all();
        return view('game.index',[
            'games' =>  $games
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
        $plans = Plan::where('active',true)->get();
        $levels = Level::where('active',true)->get();
        return view('game.create',[
            'plans' => $plans,
            'levels' => $levels
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
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'level_id' => 'required|string|exists:levels,id',
            'plan_id' => 'required|string|exists:plans,id',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'active'=> 'required'
        ]);


        if(!$validator->fails()){

            if($request->hasFile('image')){
                $filePath = $this->uploadFile($request->file('image'));
            }
            $game = new Game;
            $game->name_en = $request->input('name_en');
            $game->name_ar = $request->input('name_ar');
            $game->level_id = $request->input('level_id');
            $game->plan_id = $request->input('plan_id');
            $game->image = $filePath;
            $game->active = $request->input('active') == "true" ? true : false;
            $game->save();

            $data = [
                'title' => __('dash.notfy_add_game_title'),
                'body' => __('dash.notfy_add_game_body') . App::isLocal('ar') ? $game->name_ar : $game->name_en
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
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('game.show',[
            'game' => $game,
            'histores' => $game->history
        ]);
        //
    }

    public function getAnlyt(Request $request , Game $game){
        $result = [];
        $count = 1;
        $histores = $game->history;
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
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
        $plans = Plan::where('active',true)->get();
        $levels = Level::where('active',true)->get();
        return view('game.edit',[
            'game' => $game,
            'plans' => $plans,
            'levels' => $levels
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
        $validator = Validator($request->all(),[
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'level_id' => 'required|string|exists:levels,id',
            'plan_id' => 'required|string|exists:plans,id',
            $this->getImageValidate($request->hasFile('image'))['image'],
            'active'=> 'required'
        ]);


        if(!$validator->fails()){

            $game->name_en = $request->input('name_en');
            $game->name_ar = $request->input('name_ar');
            $game->level_id = $request->input('level_id');
            $game->plan_id = $request->input('plan_id');
            if($request->hasFile('image')){
                $filePath = $this->uploadFile($request->file('image'));
                $game->image = $filePath;

            }
            $game->active = $request->input('active') == "true" ? true : false;
            $game->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_create') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    public function getImageValidate($bool){
        if($bool){
            return ['image' => 'required|image|mimes:jpg,png,jpeg,gif'];
        }
        return ['image' => 'nullable'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
        $isDelete = $game->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

        /**
     * Change the status user.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Game $game){
        if($game->active){
            $game->active = false;
        }else{
            $game->active = true;
        }
        $isSave = $game->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
