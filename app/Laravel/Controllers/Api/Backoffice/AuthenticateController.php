<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\Backoffice\RegisterRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\Backoffice\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str;

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
        $this->guard = "backoffice";
    }

    public function authenticate(PageRequest $request){
        $email = Str::lower($request->input('email'));
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

    public function register(RegisterRequest $request){
        DB::beginTransaction();
        try{
            $password = Str::random(8);

            $user = new User;
            $user->firstname = Str::upper($request->input('firstname'));
            $user->middlename = Str::upper($request->input('middlename'));
            $user->lastname = Str::upper($request->input('lastname'));
            $user->suffix = Str::upper($request->input('suffix'));
            $user->username = Str::lower($request->input('username'));
            $user->type = "author";
            $user->email = Str::lower($request->input('email'));
            $user->password = bcrypt($password);
            $user->save();

            DB::commit();

            $token = auth($this->guard)->tokenById($user->id);

            $this->response['status'] = true;
            $this->response['status_code'] = "USER_REGISTERED";
            $this->response['msg'] = "You have been registered {$user->name}.";
            $this->response['token'] = $token;
            $this->response['token_type'] = "Bearer";
            $this->response['data'] = $this->transformer->transform($user, new UserTransformer(), 'item');
            $this->response_code = 201;

            goto callback;
        }catch(\Exception $e){
            DB::rollback();

            $error = $this->db_error($e->getLine());
            return response()->json($error['body'], $error['code']);
        }

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