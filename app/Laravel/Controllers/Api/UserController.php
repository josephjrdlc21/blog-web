<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\UserRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str;

class UserController extends Controller{
    use ResponseGenerator;

    protected $transformer;
    protected $data;
    protected $response;
    protected $response_code;

    public function __construct(){
        parent::__construct();
        $this->transformer = new TransformerManager;
        $this->response = ['msg' => "Bad Request.", "status" => false, 'status_code' => "BAD_REQUEST"];
    }

    public function index(PageRequest $request){
        $users = User::get();

        $this->response['status'] = true;
        $this->response['status_code'] = "USERS_LIST";
        $this->response['msg'] = "List of Users";
        $this->response['data'] = $this->transformer->transform($users, new UserTransformer(), 'collection');
        $this->response_code = 200;

        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function store(UserRequest $request){
        DB::beginTransaction();
        try{
            $password = Str::random(8);

            $user = new User;
            $user->firstname = Str::upper($request->input('firstname'));
            $user->middlename = Str::upper($request->input('middlename'));
            $user->lastname = Str::upper($request->input('lastname'));
            $user->suffix = Str::upper($request->input('suffix'));
            $user->username = Str::lower($request->input('username'));
            $user->type = $request->input('type');
            $user->email = Str::lower($request->input('email'));
            $user->password = bcrypt($password);
            $user->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "USERS_CREATED";
            $this->response['msg'] = "User has been created.";
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

    public function edit(PageRequest $request,$id = null){
        $user = User::find($id);

        if(!$user){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        $this->response['status'] = true;
        $this->response['status_code'] = "EDIT_USER";
        $this->response['msg'] = "Edit User Details";
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer(), 'item');
        $this->response_code = 200;
        
        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function update(UserRequest $request,$id = null){
        $user = User::find($id);

        if(!$user){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        DB::beginTransaction();
        try{
            $user->firstname = Str::upper($request->input('firstname'));
            $user->middlename = Str::upper($request->input('middlename'));
            $user->lastname = Str::upper($request->input('lastname'));
            $user->suffix = Str::upper($request->input('suffix'));
            $user->username = Str::lower($request->input('username'));
            $user->type = $request->input('type');
            $user->email = Str::lower($request->input('email'));
            $user->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "USERS_UPDATED";
            $this->response['msg'] = "User has been updated.";
            $this->response['data'] = $this->transformer->transform($user, new UserTransformer(), 'item');
            $this->response_code = 200;

            goto callback;
        }catch(\Exception $e){
            DB::rollback();

            $error = $this->db_error($e->getLine());
            return response()->json($error['body'], $error['code']);
        }

        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function show(PageRequest $request,$id = null){
        $user = User::find($id);

        if(!$user){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        $this->response['status'] = true;
        $this->response['status_code'] = "SHOW_USER";
        $this->response['msg'] = "Show User Details";
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer(), 'item');
        $this->response_code = 200;
        
        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }
}
