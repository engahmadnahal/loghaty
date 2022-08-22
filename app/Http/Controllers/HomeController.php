<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Children;
use App\Models\Classe;
use App\Models\Father;
use App\Models\Game;
use App\Models\Level;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Teacher;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
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
        $teachers = Teacher::where('status','active')->get();
        $childrens = Children::where('status','active')->get();
        $fathers = Father::where('status','active')->count();
        $classes = Classe::where('status','active')->get();
        $totalSub = Subscription::where('expire','<>',null)->count();
        $plans = Plan::where('active',true)->count();
        $levles = Level::where('active',true)->count();
        $games = Game::where('active',true)->count();
        $permission = Permission::count();
        
        return view('index',[
            'admins' =>$admins ,
            'teachers' =>$teachers ,
            'childrens' =>$childrens ,
            'fathers' =>$fathers ,
            'classes' =>$classes ,
            'totalSub' =>$totalSub ,
            'plans' =>$plans ,
            'levles' =>$levles ,
            'games' =>$games ,
            'permission' =>$permission ,
           
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function setLocal(Request $request){

        $validator = Validator($request->all(),[
            'keylang' => 'required|string'
        ]);
        if(!$validator->fails()){
            session()->put('lang',$request->input('keylang'));
            return response()->json(['message'=>'تم تغير اللغة بنجاح'],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
}
