<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameSingleResource;
use App\Http\Resources\MainResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{
    //

    public function getAllGame(Request $request){

        // Check Game equal plan user
        $games = Game::whereHas('plan',function($q){
            $q->where('active',true)->where('plan_id','<=',auth()->user()->plan_id);
        })->get();

        return new MainResource(GameResource::collection($games),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getSingleGame(Request $request,Game $game){
        return new MainResource(new GameSingleResource($game),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }
}
