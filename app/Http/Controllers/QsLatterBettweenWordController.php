<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Game;
use App\Models\QsLatterBettweenWord;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QsLatterBettweenWordController extends Controller
{
    
    use CustomTrait;
    
    //


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $QsLatterBettweenWords = QsLatterBettweenWord::all();
        return view('QsLatterBettweenWord.index',[
            'qs' =>  $QsLatterBettweenWords
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
        return view('QsLatterBettweenWord.create',[
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
            'image_two' => 'required|image|mimes:jpg,jpeg,gif,png',
            'image_three' => 'required|image|mimes:jpg,jpeg,gif,png',

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

            $sumPointsAllQs = QsLatterBettweenWord::where('game_id',$request->input('game_id'))->sum('points');
            $game = Game::find($request->input('game_id'));
            $totalPointLevel = $game->level->points;
            if($sumPointsAllQs > $totalPointLevel){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.points_grth_total_level') 
                ],Response::HTTP_BAD_REQUEST);
            }
            if($request->hasFile('image_one')){
                $filePath1 = $this->uploadFile($request->file('image_one'));
            }
            if($request->hasFile('image_three')){
                $filePath2 = $this->uploadFile($request->file('image_three'));
            }
            if($request->hasFile('image_three')){
                $filePath3 = $this->uploadFile($request->file('image_three'));
            }
            $QsLatterBettweenWord = new QsLatterBettweenWord;

            $QsLatterBettweenWord->title_ar = $request->input('title_ar');
            $QsLatterBettweenWord->title_en = $request->input('title_en');

            $QsLatterBettweenWord->quess_en = $request->input('quess_en');
            $QsLatterBettweenWord->quess_ar = $request->input('quess_ar');

            $QsLatterBettweenWord->answer_en = $request->input('answer_en');
            $QsLatterBettweenWord->answer_ar = $request->input('answer_ar');

            $QsLatterBettweenWord->image_one = $filePath1;
            $QsLatterBettweenWord->image_two = $filePath2;
            $QsLatterBettweenWord->image_three = $filePath3;

            $QsLatterBettweenWord->option_one_ar = $request->input('option_one_ar');
            $QsLatterBettweenWord->option_one_en = $request->input('option_one_en');

            $QsLatterBettweenWord->option_two_ar = $request->input('option_two_ar');
            $QsLatterBettweenWord->option_two_en = $request->input('option_two_en');

            $QsLatterBettweenWord->option_three_ar = $request->input('option_three_ar');
            $QsLatterBettweenWord->option_three_en = $request->input('option_three_en');


            $QsLatterBettweenWord->points = $request->input('points');
            $QsLatterBettweenWord->game_id = $request->input('game_id');

            $QsLatterBettweenWord->save();


            
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
     * @param  \App\Models\QsLatterBettweenWord  $QsLatterBettweenWord
     * @return \Illuminate\Http\Response
     */
    public function show(QsLatterBettweenWord $QsLatterBettweenWord)
    {
        return view('QsLatterBettweenWord.show',[
            'QsLatterBettweenWord' => $QsLatterBettweenWord
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QsLatterBettweenWord  $QsLatterBettweenWord
     * @return \Illuminate\Http\Response
     */
    public function edit(QsLatterBettweenWord $QsLatterBettweenWord)
    {
        //
        $games = Game::where('active',true)->get();
        return view('QsLatterBettweenWord.edit',[
            'qs' => $QsLatterBettweenWord,
            'games' => $games
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QsLatterBettweenWord  $QsLatterBettweenWord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QsLatterBettweenWord $QsLatterBettweenWord)
    {
        //
        $validator = Validator($request->all(),[
            'title_ar' => 'required|string',
            'title_en' => 'required|string',

            'quess_en' => 'required|string',
            'quess_ar' => 'required|string',

            'answer_en' => 'required|string',
            'answer_ar' => 'required|string',

            $this->getImageValidate('image_one',$request->hasFile('image_one'))['image_one'],
            $this->getImageValidate('image_two',$request->hasFile('image_one'))['image_two'],
            $this->getImageValidate('image_three',$request->hasFile('image_one'))['image_three'],

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

            $sumPointsAllQs = QsLatterBettweenWord::where('game_id',$request->input('game_id'))->sum('points');
            $game = Game::find($request->input('game_id'));
            $totalPointLevel = $game->level->points;
            if($sumPointsAllQs > $totalPointLevel){
                return response()->json([
                    'title'=> __('msg.error'),
                    'message'=>__('msg.points_grth_total_level') 
                ],Response::HTTP_BAD_REQUEST);
            }
           

            $QsLatterBettweenWord->title_ar = $request->input('title_ar');
            $QsLatterBettweenWord->title_en = $request->input('title_en');

            $QsLatterBettweenWord->quess_en = $request->input('quess_en');
            $QsLatterBettweenWord->quess_ar = $request->input('quess_ar');

            $QsLatterBettweenWord->answer_en = $request->input('answer_en');
            $QsLatterBettweenWord->answer_ar = $request->input('answer_ar');
    
            if($request->hasFile('image_one')){
                $filePath1 = $this->uploadFile($request->file('image_one'));
                $QsLatterBettweenWord->image_one = $filePath1;
            }
            if($request->hasFile('image_three')){
                $filePath2 = $this->uploadFile($request->file('image_three'));
                $QsLatterBettweenWord->image_two = $filePath2;
            }
            if($request->hasFile('image_three')){
                $filePath3 = $this->uploadFile($request->file('image_three'));
                $QsLatterBettweenWord->image_three = $filePath3;
            }

            $QsLatterBettweenWord->option_one_ar = $request->input('option_one_ar');
            $QsLatterBettweenWord->option_one_en = $request->input('option_one_en');

            $QsLatterBettweenWord->option_two_ar = $request->input('option_two_ar');
            $QsLatterBettweenWord->option_two_en = $request->input('option_two_en');

            $QsLatterBettweenWord->option_three_ar = $request->input('option_three_ar');
            $QsLatterBettweenWord->option_three_en = $request->input('option_three_en');

            $QsLatterBettweenWord->points = $request->input('points');
            $QsLatterBettweenWord->game_id = $request->input('game_id');

            $QsLatterBettweenWord->save();


            
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
     * @param  \App\Models\QsLatterBettweenWord  $QsLatterBettweenWord
     * @return \Illuminate\Http\Response
     */
    public function destroy(QsLatterBettweenWord $QsLatterBettweenWord)
    {
        //
        $isDelete = $QsLatterBettweenWord->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    //
}
