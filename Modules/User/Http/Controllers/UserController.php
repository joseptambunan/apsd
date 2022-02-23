<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
Use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Jobs\RegisterUser;

class UserController extends Controller
{
    public function __construct(){
        $this->configKey = "APSD";
    }

    public function token(){
        $token = csrf_token();
        echo $token;
    }

    public function create(Request $request){
        $userName = $request->user_name;
        $password = $request->password;
        $email = $request->email;
        $phone = $request->phone;

        try{
            $createUser = new User();
            $createUser->name = $userName;
            $createUser->email = $email;
            $createUser->created_at = date("Y-m-d H:i:s");
            $createUser->password = bcrypt($password);
            $createUser->phone = $phone;
            $createUser->save();

            $userDetail = User::find($createUser->id);
            RegisterUser::dispatch($userDetail);
            $response['code'] = "SUCCESS";
            $response['message'] = "User has Created Successfully";
        }catch(Exception $e) {
            $response['code'] = "FAILED";
            $response['message'] = $e->getMessage();
        }

        
        echo json_encode($response);
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $credentials = $request->only('email', 'password');
        if ( Auth::attempt($credentials)){
            $userData = User::find(Auth::user()->id);
            $dataAccessToken['name'] = $userData->name;
            $dataAccessToken['email'] = $userData->email;
            $dataAccessToken['remember_token'] = $userData->remember_token;
            $dataAccessToken['phone'] = $userData->phone;
            $dataAccessToken['user_id'] = $userData->id;
            $configKey = $this->configKey;
            $access_token = JWT::encode($dataAccessToken, $configKey, 'HS256');
            $response['code'] = "SUCCESS LOGIN";
            $response['access_token'] = $access_token;
            echo json_encode($response);
            http_response_code(200);
            exit();
        }else{
            $response['code'] = "FAILED";
            echo json_encode($response);
        }

    }

    public function view(Request $request){
        $accessToken = $request->access_token;
        $decodedJWT = JWT::decode($accessToken, new Key('APSD', 'HS256'));
        echo json_encode($decodedJWT);
    }

    public function destroy(Request $request){
        $accessToken = $request->access_token;
        $decodedJWT = JWT::decode($accessToken, new Key('APSD', 'HS256'));
        $user_id = $decodedJWT->user_id;
        try{
            $user_deleted = User::find($user_id);
            $user_deleted->delete();
            $response['code'] = "DELETED";
            echo json_encode($response);
        }catch(Exception $e){
            $response['code'] = "FAILED";
            echo json_encode($response);
        }
    }

    public function test(){
        $response['code'] = "SUCCESS";
        $response['message'] = "Success Install";
        echo json_encode($response);
    }
}
