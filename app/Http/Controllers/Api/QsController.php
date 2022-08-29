<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\MainResource;
use App\Http\Resources\QsCompletelatterResource;
use App\Http\Resources\QslatterbettweenWordResource;
use App\Http\Resources\QsOrderLatterResource;
use App\Http\Resources\QsPlayingResource;
use App\Models\QsCompleteLatter;
use App\Models\QsLatterBettweenWord;
use App\Models\QsOrderLatter;
use App\Models\QsPlaying;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QsController extends Controller
{
    //

    public function getQsCompleteLatter(Request $request,QsCompleteLatter $qsCompleteLatter){
        return new MainResource(new QsCompletelatterResource($qsCompleteLatter),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getQsLatterBettweenWord(Request $request,QsLatterBettweenWord $qsLatterBettweenWord){
        return new MainResource(new QslatterbettweenWordResource($qsLatterBettweenWord),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getQsOrderdLatter(Request $request,QsOrderLatter $qsOrderLatter){
        return new MainResource(new QsOrderLatterResource($qsOrderLatter),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }


    public function getQsPlaying(Request $request,QsPlaying $qsPlaying){
        return new MainResource(new QsPlayingResource($qsPlaying),Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));
    }
}
