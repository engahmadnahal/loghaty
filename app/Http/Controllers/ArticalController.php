<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Artical;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ArticalController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Artical::class,'artical');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $articals = Artical::all();
        return view('artical.index',[
            'articals' => $articals
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
        return view('artical.create');

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
            'title_ar' => 'required|string|min:10|max:40',
            'title_en' => 'required|string|min:10|max:40',
            'body_ar' => 'required|string|min:50',
            'body_en' => 'required|string|min:50',
        ]);

        if(!$validator->fails()){

            $artical = new Artical;
            $artical->title_ar = $request->input('title_ar');
            $artical->title_en = $request->input('title_en');
            $artical->body_ar = $request->input('body_ar');
            $artical->body_en = $request->input('body_en');
            $artical->admin_id = auth()->user()->id;
            $isSave = $artical->save();
            
            $data = [
                'title' => __('dash.notfy_add_artical_title'),
                'body' => __('dash.notfy_add_artical_body') . App::isLocal('ar') ? $artical->name_ar : $artical->name_en
            ];
            // Send Notification only Admin has permission revers_notification
            $admins = Admin::all();
            foreach($admins as $a){
                if($a->hasPermissionTo('revers_notification')){
                    $a->notify(new AdminNotification($data));
                }
            }
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function show(Artical $artical)
    {
        //
        return view('artical.show',[
            'artical' => $artical
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function edit(Artical $artical)
    {
        //
        return view('artical.edit',[
            'artical' => $artical
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artical $artical)
    {
        //
        $validator = Validator($request->all(),[
            'title_ar' => 'required|string|min:10|max:40',
            'title_en' => 'required|string|min:10|max:40',
            'body_ar' => 'required|string|min:50',
            'body_en' => 'required|string|min:50',
        ]);

        if(!$validator->fails()){
            
            $artical->title_ar = $request->input('title_ar');
            $artical->title_en = $request->input('title_en');
            $artical->body_ar = $request->input('body_ar');
            $artical->body_en = $request->input('body_en');
            $artical->admin_id = auth()->user()->id;
            $isSave = $artical->save();
            
            return response()->json([
                'title'=>$isSave ? __('msg.success') : __('msg.error'),
                'message'=>$isSave ? __('msg.success_create') :  __('msg.error_create')
            ],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artical $artical)
    {
        //
        $isDelete = $artical->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
