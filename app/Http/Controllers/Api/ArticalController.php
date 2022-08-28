<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\ArticalResource;
use App\Http\Resources\MainResource;
use App\Models\Artical;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticalController extends Controller
{
    //

    public function getAllArtical(Request $request){

        $articals = Artical::all();
        return new MainResource(ArticalResource::collection($articals),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getSingleArtical(Request $request, Artical $artical){
        return new MainResource(new ArticalResource($artical),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }
}
