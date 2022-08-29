<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Game;
use App\Models\QsOrderLatter;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class QsOrderLatterController extends Controller
{
    //

    use CustomTrait;
    
    //

    public function __construct()
    {
        $this->authorizeResource(QsOrderLatter::class,'QsOrderLatter');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $QsOrderLatters = QsOrderLatter::all();
        return view('QsOrderLatter.index',[
            'qs' =>  $QsOrderLatters
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
        return view('QsOrderLatter.create',[
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

            'image' => 'required|image|mimes:jpg,jpeg,gif,png',

            'body_ar' => 'required|string',
            'body_en' => 'required|string',

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsOrderLatter::where('game_id',$request->input('game_id'))->sum('points');
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
            if($request->hasFile('image')){
                $filePath = $this->uploadFile($request->file('image'));
            }
            
            $QsOrderLatter = new QsOrderLatter;

            $QsOrderLatter->title_ar = $request->input('title_ar');
            $QsOrderLatter->title_en = $request->input('title_en');

            $QsOrderLatter->quess_en = $request->input('quess_en');
            $QsOrderLatter->quess_ar = $request->input('quess_ar');

            $QsOrderLatter->answer_en = $request->input('answer_en');
            $QsOrderLatter->answer_ar = $request->input('answer_ar');

            $QsOrderLatter->image = $filePath;

            $QsOrderLatter->body_ar = $request->input('body_ar');
            $QsOrderLatter->body_en = $request->input('body_en');

            $QsOrderLatter->points = $request->input('points');
            $QsOrderLatter->game_id = $request->input('game_id');

            $QsOrderLatter->save();

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
     * @param  \App\Models\QsOrderLatter  $QsOrderLatter
     * @return \Illuminate\Http\Response
     */
    // public function show(QsOrderLatter $QsOrderLatter)
    // {
    //     // return view('QsOrderLatter.show',[
    //     //     'QsOrderLatter' => $QsOrderLatter
    //     // ]);
    //     return redirect()->route('qs_order_latters.edit');

    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsOrderLatter  $QsOrderLatter
     * @return \Illuminate\Http\Response
     */
    public function edit(QsOrderLatter $QsOrderLatter)
    {
        //
        $games = Game::where('active',true)->get();
        return view('QsOrderLatter.edit',[
            'qs' => $QsOrderLatter,
            'games' => $games
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsOrderLatter  $QsOrderLatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsOrderLatter $QsOrderLatter)
    {
        //
        $validator = Validator($request->all(),[
            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'quess_en' => 'required|string',
            'quess_ar' => 'required|string',

            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',

            $this->getImageValidate('image',$request->hasFile('image'))['image'],

            'body_ar' => 'required|string',
            'body_en' => 'required|string',

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsOrderLatter::where('game_id',$request->input('game_id'))->sum('points');
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
            
            

            $QsOrderLatter->title_ar = $request->input('title_ar');
            $QsOrderLatter->title_en = $request->input('title_en');

            $QsOrderLatter->quess_en = $request->input('quess_en');
            $QsOrderLatter->quess_ar = $request->input('quess_ar');

            $QsOrderLatter->answer_en = $request->input('answer_en');
            $QsOrderLatter->answer_ar = $request->input('answer_ar');
            if($request->hasFile('image')){
                $filePath = $this->uploadFile($request->file('image'));
                $QsOrderLatter->image = $filePath;

            }

            $QsOrderLatter->body_ar = $request->input('body_ar');
            $QsOrderLatter->body_en = $request->input('body_en');

            $QsOrderLatter->points = $request->input('points');
            $QsOrderLatter->game_id = $request->input('game_id');

            $QsOrderLatter->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_edit') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }
    public function getImageValidate($attr,$bool){
        if($bool){
            return [$attr => 'required|image|mimes:jpg,jpeg,gif,png'];
        }
        return [$attr => 'nullable'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QsOrderLatter  $QsOrderLatter
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsOrderLatter $QsOrderLatter)
    {
        //
        $isDelete = $QsOrderLatter->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
