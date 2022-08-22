<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $countries = Country::all();
        return view('country.index',[
            'countries' => $countries
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

        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name_en'=>'required|string',
            'name_en'=>'required|string',
            'active'=>'required|boolean'
        ]);

        if(!$validator->fails()){
            $country = new Country;
            $country->name_en = $request->input('name_en');
            $country->name_ar = $request->input('name_ar');
            $country->active = $request->input('active');
            $isSave = $country->save();
            return response()->json(['title'=>__('msg.success'),'message'=>$isSave ? __('msg.success_create') : __('msg.error_create')],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
        return view('country.show',[
            'country' => $country
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
        return view('country.edit',[
            'country'=>$country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
        $validator = Validator($request->all(),[
            'name_en'=>'required|string',
            'name_en'=>'required|string',
            'active'=>'nullable|boolean'
        ]);

        if(!$validator->fails()){
            $country->name_en = $request->input('name_en');
            $country->name_ar = $request->input('name_ar');
            $country->active = $request->input('active');
            $isSave = $country->save();
            return response()->json(['title'=>__('msg.success'),'message'=>$isSave ? __('msg.success_edit') : __('msg.error_edit')],Response::HTTP_OK);
        }else{
            return response()->json(['title'=>__('msg.error'),'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
        $isDelete = $country->delete();
        return response()->json([
            'title' => $isDelete ? __('msg.success') : __('msg.error'),
            'message' =>$isDelete ? __('msg.success_delete') : __('msg.error_delete')
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


   /**
     * Change the status user.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Country $country){
        if($country->active){
            $country->active = false;
        }else{
            $country->active = true;
        }
        $isSave = $country->save();

        return response()->json([
            'title' => $isSave ? __('msg.success') : __('msg.error'),
            'message' =>$isSave ? __('msg.success_action') : __('msg.error_action')
        ],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
