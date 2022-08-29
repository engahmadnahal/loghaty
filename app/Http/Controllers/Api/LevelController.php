<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\LevelResource;
use App\Http\Resources\LevelSingleResource;
use App\Http\Resources\MainResource;
use App\Models\Level;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    //

    public function getAllLevels(Request $request){
        $levels = Level::where('active',true)->get();
        return new MainResource(LevelResource::collection($levels),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getSingleLevels(Request $request,Level $level){
        return new MainResource(new LevelSingleResource($level),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }
}
