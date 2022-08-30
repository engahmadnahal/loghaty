<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\FatherResource;
use App\Http\Resources\MainResource;
use App\Models\Father;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class FatherController extends Controller
{
    //

    public function register(Request $request){
        $validator = Validator($request->all(),[
            'email' => 'required|email|unique:fathers',
            'password' => 'required|string|min:6|max:12',
            'country_id' => 'required|numeric|exists:countries,id',
        ]);

        if(!$validator->fails()){
            $father = new Father;
            $father->email = $request->input('email');
            $father->password = Hash::make($request->input('password'));
            $father->plan_id = 1;
            $father->country_id = $request->input('country_id');
            $father->status = 'active';
            $father->save();

            return $this->grantPGCT($request);
            
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }

    }


    function grantPGCT(Request $request){
        $response = Http::asForm()->post(env('APP_URL').'/oauth/token',[
        // $response = Http::asForm()->post('https://loghaty.ahmadnahal.com/oauth/token',[
            'grant_type' => 'password',
            'client_id' => 4,
            'client_secret'=>'qupjQR89J8JRN8jwKE46tQkGlXX95bYzm5lDWyRq',
            'username' => $request->input('email'),
            'password' =>$request->input('password'),
            'scope' => '*'
        ]);
        $decodedResponse = json_decode($response);
        $father = Father::where('email',$request->input('email'))->first();
        $father->setAttribute('token',$decodedResponse->access_token);

        return new MainResource(new FatherResource($father),Response::HTTP_OK,ApiMsg::getMsg($request,'success_create'));     
    }

    


    public function sendSetting(Request $request, Father $father){
        $validator = Validator($request->all(),[
            'lang_text' => 'required|string',
            'lang_voice' => 'required|string',
            'is_music' => 'required|boolean',
        ]);

        if(!$validator->fails()){
            Setting::updateOrCreate(
                [
                    'father_id' => $father->id
                ],
                [
                    'lang_text' => $request->input('lang_text'),
                    'lang_voice' => $request->input('lang_voice'),
                    'is_music' => $request->input('is_music'),
                ]
            );
            return response()->json([
                'status'=>true,
                'title'=> ApiMsg::getMsg($request,'success'),
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function getSetting(Request $request ,Father $father){
        $setting = $father->setting;
        if(!is_null($setting)){
            return new MainResource([
                'lang_text' => $setting->lang_text,
                'lang_voice' => $setting->lang_voice,
                'is_music' => $setting->is_music
            ],Response::HTTP_OK,ApiMsg::getMsg($request,'success'));
        }else{
            return response()->json([
                'status'=>true,
                'title'=> ApiMsg::getMsg($request,'default_data'),
                'data' => [
                    'lang_text' => 'ar',
                    'lang_voice' => 'ar',
                    'is_music' => true
                ]
            ],Response::HTTP_OK);
        }
        
    }


    public function getInfo(Request $request,Father $father){
        $data = [
            'email' => $father->email,
            'password' => '*************',
            'country' => $father->country->name
        ];
        return new MainResource($data,Response::HTTP_OK,ApiMsg::getMsg($request,'success_get'));     
    }


    public function editInfo(Request $request,Father $father){
        $validator = Validator($request->all(),[
            'email' => 'required|string',
            'password' => 'required|min:6|max:12|confirmed',
        ]);

        if(!$validator->fails()){

            $father->email = $request->input('email');
            $father->password = Hash::make($request->input('password'));
            $father->save();

            return $this->grantPGCT($request);
        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    public function sendVist(Request $request,Father $father){

        $father->last_vist = Carbon::now();
        $father->save();
       
            return response()->json([
                'status'=>true,
                'title'=> ApiMsg::getMsg($request,'success'),
            ],Response::HTTP_OK);

    }


}
