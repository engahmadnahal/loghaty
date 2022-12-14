<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Children;
use App\Models\Classe;
use App\Models\Father;
use App\Models\Game;
use App\Models\History;
use App\Models\Level;
use App\Models\Plan;
use App\Models\Semester;
use App\Models\Subscription;
use App\Models\Teacher;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::where('status','active')->get();
        $teachers = Teacher::where('status','active')->latest()->get();
        $childrens = Children::where('status','active')->latest()->get();
        $fathers = Father::where('status','active')->count();
        $fathersData = Father::where('status','active')->latest()->get();
        $semesters = Semester::where('status','active')->get();
        $totalSub = Subscription::where('expire',null)->count();
        $subsData = Subscription::where('expire',null)->get();
        $plans = Plan::where('active',true)->count();
        $levles = Level::where('active',true)->count();
        $games = Game::where('active',true)->count();
        $permission = Permission::count();
        $histores = History::all();
        
        return view('index',[
            'histores'=>$histores,
            'admins' =>$admins ,
            'teachers' =>$teachers ,
            'childrens' =>$childrens ,
            'fathers' =>$fathers ,
            'fathersData' =>$fathersData ,
            'classes' =>$semesters ,
            'totalSub' =>$totalSub ,
            'plans' =>$plans ,
            'levles' =>$levles ,
            'games' =>$games ,
            'permission' =>$permission ,
            'subsData' => $subsData
           
        ]);
    }

    

    public function setLocal(Request $request){

        $validator = Validator($request->all(),[
            'keylang' => 'required|string|in:en,ar'
        ]);
        if(!$validator->fails()){
            session()->put('lang', $request->input('keylang'));
            return response()->json(['message'=>'???? ???????? ?????????? ??????????'],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
}
