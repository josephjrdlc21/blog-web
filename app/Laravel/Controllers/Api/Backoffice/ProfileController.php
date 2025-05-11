<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\Backoffice\ProfileRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\Backoffice\ProfileTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str,Carbon,ImageUploader;

class ProfileController extends Controller{
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

    public function index(PageRequest $request){
        $auth = auth($this->guard)->user();

        if(!$auth){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        $this->response['status'] = true;
        $this->response['status_code'] = "PROFILE";
        $this->response['msg'] = "Profile Details";
        $this->response['data'] = $this->transformer->transform($auth, new ProfileTransformer(), 'item');
        $this->response_code = 200;
        
        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function update(ProfileRequest $request){
        $auth = auth($this->guard)->user();

        if(!$auth){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        DB::beginTransaction();
        try{
            $auth->firstname = Str::upper($request->input('firstname'));
            $auth->middlename = Str::upper($request->input('middlename'));
            $auth->lastname = Str::upper($request->input('lastname'));
            $auth->suffix = Str::upper($request->input('suffix'));
            $auth->username = Str::lower($request->input('username'));
            $auth->email = Str::lower($request->input('email'));
            $auth->save();

            if($request->hasFile('image')){
                $image = ImageUploader::upload($request->file('image'), "uploads/profile/{$auth->id}");
    
                $auth->path      = $image['path'];
                $auth->directory = $image['directory'];
                $auth->filename  = $image['filename'];
                $auth->source    = $image['source'];
                $auth->save();
            }

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "PROFILE_UPDATED";
            $this->response['msg'] = "Profile has been updated.";
            $this->response['data'] = $this->transformer->transform($auth, new ProfileTransformer(), 'item');
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

    public function update_password(ProfileRequest $request){
        $auth = auth($this->guard)->user();

        if(!$auth){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        DB::beginTransaction();
        try{
            $auth->password = bcrypt($request->input('password'));
            $auth->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "CHANGE_PASSWORD";
            $this->response['msg'] = "Password has been updated.";
            $this->response['data'] = $this->transformer->transform($auth, new ProfileTransformer(), 'item');
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
}