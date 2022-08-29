<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use App\Models\Game;
use App\Models\QsCompleteLatter;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class QsCompleteLatterController extends Controller
{
    use CustomTrait;
    
    //

    public function __construct()
    {
        $this->authorizeResource(QsCompleteLatter::class,'qs_complete_latters');
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $QsCompleteLatters = QsCompleteLatter::all();
        return view('QsCompleteLatter.index',[
            'qs' =>  $QsCompleteLatters
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
        return view('QsCompleteLatter.create',[
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

            'image_one' => 'required|image|mimes:jpg,jpeg,gif,png',

            'option_one_ar' => 'required|string',
            'option_one_en' => 'required|string',

            'option_two_ar' => 'required|string',
            'option_two_en' => 'required|string',

            'option_three_ar' => 'required|string',
            'option_three_en' => 'required|string',

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsCompleteLatter::where('game_id',$request->input('game_id'))->sum('points');
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
            if($request->hasFile('image_one')){
                $filePath = $this->uploadFile($request->file('image_one'));
            }
            $QsCompleteLatter = new QsCompleteLatter;

            $QsCompleteLatter->title_ar = $request->input('title_ar');
            $QsCompleteLatter->title_en = $request->input('title_en');

            $QsCompleteLatter->quess_en = $request->input('quess_en');
            $QsCompleteLatter->quess_ar = $request->input('quess_ar');

            $QsCompleteLatter->answer_en = $request->input('answer_en');
            $QsCompleteLatter->answer_ar = $request->input('answer_ar');

            $QsCompleteLatter->image_one = $filePath;

            $QsCompleteLatter->option_one_ar = $request->input('option_one_ar');
            $QsCompleteLatter->option_one_en = $request->input('option_one_en');

            $QsCompleteLatter->option_two_ar = $request->input('option_two_ar');
            $QsCompleteLatter->option_two_en = $request->input('option_two_en');

            $QsCompleteLatter->option_three_ar = $request->input('option_three_ar');
            $QsCompleteLatter->option_three_en = $request->input('option_three_en');

            $QsCompleteLatter->option_one_ar = $request->input('option_one_ar');
            $QsCompleteLatter->option_one_en = $request->input('option_one_en');

            $QsCompleteLatter->points = $request->input('points');
            $QsCompleteLatter->game_id = $request->input('game_id');

            $QsCompleteLatter->save();

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
     * @param  \App\Models\QsCompleteLatter  $QsCompleteLatter
     * @return \Illuminate\Http\Response
     */
    // public function show(QsCompleteLatter $QsCompleteLatter)
    // {
    //     // return view('QsCompleteLatter.show',[
    //     //     'QsCompleteLatter' => $QsCompleteLatter
    //     // ]);
    //     return redirect()->route('qs_complete_latters.edit');
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsCompleteLatter  $QsCompleteLatter
     * @return \Illuminate\Http\Response
     */
    public function edit(QsCompleteLatter $QsCompleteLatter)
    {
        //
        $games = Game::where('active',true)->get();
        return view('QsCompleteLatter.edit',[
            'qs' => $QsCompleteLatter,
            'games' => $games
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsCompleteLatter  $QsCompleteLatter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsCompleteLatter $QsCompleteLatter)
    {
        //
        $validator = Validator($request->all(),[
            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'quess_en' => 'required|string',
            'quess_ar' => 'required|string',

            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',

            $this->getImageValidate($request->hasFile('image_one'))['image_one'],


            'option_one_ar' => 'required|string',
            'option_one_en' => 'required|string',

            'option_two_ar' => 'required|string',
            'option_two_en' => 'required|string',

            'option_three_ar' => 'required|string',
            'option_three_en' => 'required|string',

            'points' => 'required|string',
            'game_id' => 'required|string|exists:games,id',
        ]);


        if(!$validator->fails()){

            $sumPointsAllQs = QsCompleteLatter::where('game_id',$request->input('game_id'))->sum('points');
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
           

            $QsCompleteLatter->title_ar = $request->input('title_ar');
            $QsCompleteLatter->title_en = $request->input('title_en');

            $QsCompleteLatter->quess_en = $request->input('quess_en');
            $QsCompleteLatter->quess_ar = $request->input('quess_ar');

            $QsCompleteLatter->answer_en = $request->input('answer_en');
            $QsCompleteLatter->answer_ar = $request->input('answer_ar');
            if($request->hasFile('image_one')){
                $filePath = $this->uploadFile($request->file('image_one'));
                $QsCompleteLatter->image_one = $filePath;

            }
            $QsCompleteLatter->option_one_ar = $request->input('option_one_ar');
            $QsCompleteLatter->option_one_en = $request->input('option_one_en');

            $QsCompleteLatter->option_two_ar = $request->input('option_two_ar');
            $QsCompleteLatter->option_two_en = $request->input('option_two_en');

            $QsCompleteLatter->option_three_ar = $request->input('option_three_ar');
            $QsCompleteLatter->option_three_en = $request->input('option_three_en');

            $QsCompleteLatter->option_one_ar = $request->input('option_one_ar');
            $QsCompleteLatter->option_one_en = $request->input('option_one_en');

            $QsCompleteLatter->points = $request->input('points');
            $QsCompleteLatter->game_id = $request->input('game_id');

            $QsCompleteLatter->save();


            
            return response()->json([
                'title'=> __('msg.success'),
                'message'=>__('msg.success_edit') 
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }
    public function getImageValidate($bool){
        if($bool){
            return ['image_one' => 'required|image|mimes:jpg,jpeg,gif,png'];
        }
        return ['image_one' => 'nullable'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QsCompleteLatter  $QsCompleteLatter
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsCompleteLatter $QsCompleteLatter)
    {
        //
        $isDelete = $QsCompleteLatter->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
