<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
//use App\Laravel\Requests\Api\RegisterRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB;

class AuthenticateController extends Controller{
    use ResponseGenerator;

    protected $transformer;
    protected $data;
    protected $response;
    protected $response_code;
    protected $guard;

    public function __construct(){
        parent::__construct();
        $this->transformer = new TransformerManager;
        $this->response = ['msg' => "Bad Request.", "status" => false, 'status_code' => "BAD_REQUEST"];
        $this->guard = "api";
    }

    public function authenticate(PageRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if(!$token = auth($this->guard)->attempt(['email' => $email, 'password' => $password])){
            $this->response['status'] = false;
            $this->response['status_code'] = "UNAUTHORIZED";
            $this->response['msg'] = "Invalid account credentials.";
            $this->response_code = 401;

            goto callback;
        }

        $user = auth($this->guard)->user();

        $this->response['status'] = true;
        $this->response['status_code'] = "LOGIN_SUCCESS";
        $this->response['msg'] = "Hi {$user->name}!";
        $this->response['token'] = $token;
        $this->response['token_type'] = "Bearer";
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer, 'item');
        $this->response_code = 200;

        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function logout(PageRequest $request){
        auth($this->guard)->logout();

        $this->response['status'] = true;
        $this->response['status_code'] = "LOGOUT_SUCCESS";
        $this->response['msg'] = "Session closed.";
        $this->response_code = 200;
        
        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }
}