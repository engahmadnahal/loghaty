<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Game;
use App\Models\QsPlaying;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class QsPlayingController extends Controller
{
    //
     
    use CustomTrait;
    
    //

    public function __construct()
    {
        $this->authorizeResource(QsPlaying::class,'QsPlaying');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $QsPlayings = QsPlaying::all();
        return view('QsPlaying.index',[
            'qs' =>  $QsPlayings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     
        $games = Game::where('active',true)->get();
        return view('QsPlaying.create',[
           'games' => $games
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
            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'quess_en' => 'required|string',
            'quess_ar' => 'required|string',

            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',


            'option_one_ar' => 'required|string',
            'option_one_en' => 'required|string',

            'option_two_ar' => 'required|string',
            'option_two_en' => 'required|string',

            'option_three_ar' => 'required|string',
            'option_three_en' => 'required|string',

            'option_foure_ar' => 'required|string',
            'option_foure_en' => 'required|string',

            

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsPlaying::where('game_id',$request->input('game_id'))->sum('points');
            $game = Game::find($request->input('game_id'));
            $totalPointLevel = $game->level->points;
            if(
                ($sumPointsAllQs > $totalPointLevel) || 
                ($request->input('points') > $totalPointLevel)
            ){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.points_grth_total_level') 
                ],Response::HTTP_BAD_REQUEST);
            }
            
            $QsPlaying = new QsPlaying;

            $QsPlaying->title_ar = $request->input('title_ar');
            $QsPlaying->title_en = $request->input('title_en');

            $QsPlaying->quess_en = $request->input('quess_en');
            $QsPlaying->quess_ar = $request->input('quess_ar');

            $QsPlaying->answer_en = $request->input('answer_en');
            $QsPlaying->answer_ar = $request->input('answer_ar');


            $QsPlaying->option_one_ar = $request->input('option_one_ar');
            $QsPlaying->option_one_en = $request->input('option_one_en');

            $QsPlaying->option_two_ar = $request->input('option_two_ar');
            $QsPlaying->option_two_en = $request->input('option_two_en');

            $QsPlaying->option_three_ar = $request->input('option_three_ar');
            $QsPlaying->option_three_en = $request->input('option_three_en');

            $QsPlaying->option_foure_ar = $request->input('option_foure_ar');
            $QsPlaying->option_foure_en = $request->input('option_foure_en');

            $QsPlaying->points = $request->input('points');
            $QsPlaying->game_id = $request->input('game_id');

            $QsPlaying->save();

            $data = [
                'title' => __('dash.notfy_add_qs_title'),
                'body' => __('dash.notfy_add_qs_body') 
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
     * @param  \App\Models\QsPlaying  $QsPlaying
     * @return \Illuminate\Http\Response
     */
    // public function show(QsPlaying $QsPlaying)
    // {
    //     return view('QsPlaying.show',[
    //         'QsPlaying' => $QsPlaying
    //     ]);

    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsPlaying  $QsPlaying
     * @return \Illuminate\Http\Response
     */
    public function edit(QsPlaying $QsPlaying)
    {
        //
        $games = Game::where('active',true)->get();
        return view('QsPlaying.edit',[
            'qs' => $QsPlaying,
            'games' => $games
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsPlaying  $QsPlaying
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsPlaying $QsPlaying)
    {
        //
        $validator = Validator($request->all(),[
            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'quess_en' => 'required|string',
            'quess_ar' => 'required|string',

            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',

            'option_one_ar' => 'required|string',
            'option_one_en' => 'required|string',

            'option_two_ar' => 'required|string',
            'option_two_en' => 'required|string',

            'option_three_ar' => 'required|string',
            'option_three_en' => 'required|string',

            'option_foure_ar' => 'required|string',
            'option_foure_en' => 'required|string',

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsPlaying::where('game_id',$request->input('game_id'))->sum('points');
            $game = Game::find($request->input('game_id'));
            $totalPointLevel = $game->level->points;
            if(
                ($sumPointsAllQs > $totalPointLevel) || 
                ($request->input('points') > $totalPointLevel)
            ){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.points_grth_total_level') 
                ],Response::HTTP_BAD_REQUEST);
            }
           

            $QsPlaying->title_ar = $request->input('title_ar');
            $QsPlaying->title_en = $request->input('title_en');

            $QsPlaying->quess_en = $request->input('quess_en');
            $QsPlaying->quess_ar = $request->input('quess_ar');

            $QsPlaying->answer_en = $request->input('answer_en');
            $QsPlaying->answer_ar = $request->input('answer_ar');


            $QsPlaying->option_one_ar = $request->input('option_one_ar');
            $QsPlaying->option_one_en = $request->input('option_one_en');

            $QsPlaying->option_two_ar = $request->input('option_two_ar');
            $QsPlaying->option_two_en = $request->input('option_two_en');

            $QsPlaying->option_three_ar = $request->input('option_three_ar');
            $QsPlaying->option_three_en = $request->input('option_three_en');

            $QsPlaying->option_foure_ar = $request->input('option_foure_ar');
            $QsPlaying->option_foure_en = $request->input('option_foure_en');

            $QsPlaying->points = $request->input('points');
            $QsPlaying->game_id = $request->input('game_id');

            $QsPlaying->save();


            
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
     * @param  \App\Models\QsPlaying  $QsPlaying
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsPlaying $QsPlaying)
    {
        //
        $isDelete = $QsPlaying->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
