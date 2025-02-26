<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
//use App\Laravel\Requests\Api\UserRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB;

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
}
