<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiMsg;
use App\Http\Resources\FatherResource;
use App\Http\Resources\MainResource;
use App\Http\Resources\TeacherResource;
use App\Models\Father;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpFoundation\Response;

class AuthLoginController extends Controller
{
    
    public function login(Request $request){
        $validator = Validator($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:12',
            'type' => 'required|string'
        ]);

        if(!$validator->fails()){
            $userLogin = $this->getUserLogin($request);
            
            if(!is_null($userLogin)){
                if(Hash::check($request->input('password'), $userLogin->password)){
                    if($userLogin->status == 'block'){
                        return response()->json([
                            'status'=>false,
                            'title'=> ApiMsg::getMsg($request,'error'),
                            'message'=> ApiMsg::getMsg($request,'block_account')
                        ],Response::HTTP_BAD_REQUEST);
                    }
                   return $this->grantPGCT($request);
                }else{
                    return response()->json([
                        'status'=>false,
                        'message' => ApiMsg::getMsg($request,'password_faild')
                    ],Response::HTTP_BAD_REQUEST);
                }
            }else{
                return new MainResource([],Response::HTTP_BAD_REQUEST,ApiMsg::getMsg($request,'notfound_account'));
            }

        }else{
            return response()->json([
                'status'=>false,
                'title'=> ApiMsg::getMsg($request,'error'),
                'message'=> $validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    function grantPGCT(Request $request){
        $response = Http::asForm()->post(env('URL_API_TOKEN'),[
                'grant_type' => 'password',
                'client_id' => $this->getClientSecret($request->input('type'))['client_id'],
                'client_secret'=>$this->getClientSecret($request->input('type'))['client_secret'],
                'username' => $request->input('email'),
                'password' =>$request->input('password'),
                'scope' => '*'
            ]);

        $decodedResponse = json_decode($response);
        $user = $this->getUserLogin($request);
        $user->last_vist = Carbon::now();
        $user->save();
        $user->setAttribute('token',$decodedResponse->access_token);
        if($request->input('type') == 'teacher'){
            return new MainResource(new TeacherResource($user),Response::HTTP_OK,ApiMsg::getMsg($request,'success_login'));
        }
        return new MainResource(new FatherResource($user),Response::HTTP_OK,ApiMsg::getMsg($request,'success_login'));     
    }

    public function getUserLogin(Request $request){
        if($request->input('type') == 'teacher'){
            return $this->getTeacher($request->input('email'));
        }else{
            return $this->getFather($request->input('email'));
        }
    }

    public function getFather($email){
        return Father::where('email',$email)->first();
    }

    public function getTeacher($email){
        return Teacher::where('email',$email)->first();
    }

    public function getClientSecret($type){
        
        $arr = [
            'client_id' => '',
            'client_secret' => ''
        ];
        if($type == 'teacher'){
            $arr['client_id'] = env('TEACHER_CLIENT_ID');
            $arr['client_secret'] = env('TEACHER_CLIENT_SECRET');
        }else{
            $arr['client_id'] = env('FATHER_CLIENT_ID');
            $arr['client_secret'] = env('FATHER_CLIENT_SECRET');
        }

        return $arr;
    }

    public function logout(Request $request){
        $token = Auth::user()->token();
        $token->revoke();
        return response()->json([
            'status' => true,
            'message' => ApiMsg::getMsg($request,'success')
        ],Response::HTTP_OK);
    }
}
