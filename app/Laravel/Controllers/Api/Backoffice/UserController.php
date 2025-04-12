<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Models\User;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\Backoffice\UserRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\Backoffice\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str,Carbon;

class UserController extends Controller{
    use ResponseGenerator;

    protected $transformer;
    protected $data;
    protected $response;
    protected $response_code;
    protected $per_page;

    public function __construct(){
        parent::__construct();
        $this->transformer = new TransformerManager;
        $this->response = ['msg' => "Bad Request.", "status" => false, 'status_code' => "BAD_REQUEST"];
        $this->per_page = env("DEFAULT_PER_PAGE", 10);
    }

    public function index(PageRequest $request){
        $this->data['keyword'] = Str::lower($request->get('keyword'));
        $this->data['type'] = $request->get('type');
        $this->data['status'] = $request->get('status');

        $first_record = User::where('id','!=',1)->orderBy('created_at', 'ASC')->first();
        $start_date = $request->get('start_date') ?? ($first_record?->created_at?->format('Y-m-d') ?? now()->startOfMonth()->format('Y-m-d'));

        $this->data['start_date'] = Carbon::parse($start_date)->format("Y-m-d");
        $this->data['end_date'] = Carbon::parse($request->get('end_date', now()))->format("Y-m-d");

        $users = User::where(function ($query) {
            if(strlen($this->data['keyword']) > 0){
                $query->whereRaw("LOWER(CONCAT(firstname, ' ',lastname)) LIKE '%{$this->data['keyword']}%'")
                    ->orWhereRaw("LOWER(email) LIKE '%{$this->data['keyword']}%'")
                    ->orWhereRaw("LOWER(username) LIKE '%{$this->data['keyword']}%'");
            }
        })
        ->where(function ($query) {
            if(strlen($this->data['type']) > 0){
                $query->where('type', $this->data['type']);
            }
        })
        ->where(function ($query) {
            if(strlen($this->data['status']) > 0){
                $query->where('status', $this->data['status']);
            }
        })
        ->where(function ($query) {
            $query->where(function ($q) {
                if(strlen($this->data['start_date']) > 0) {
                    $q->whereDate('created_at', '>=', Carbon::parse($this->data['start_date'])->format("Y-m-d"));
                }
            })->where(function ($q) {
                if(strlen($this->data['end_date']) > 0) {
                    $q->whereDate('created_at', '<=', Carbon::parse($this->data['end_date'])->format("Y-m-d"));
                }
            });
        })
        ->where('id','!=',1)
        ->orderBy('created_at','DESC')
        ->paginate($this->per_page);

        $this->response['status'] = true;
        $this->response['status_code'] = "USERS_LIST";
        $this->response['msg'] = "List of Users";
        $this->response['data'] = [
            'start_date' => $this->data['start_date'],
            'end_date' => $this->data['end_date'],
            'keyword' => $this->data['keyword'],
            'type' => $this->data['type'],
            'status' => $this->data['status'],
            'statuses' => ['' => "All", 'active' => "Active", 'inactive' => "Inactive"],
            'types' => ['' => "All", 'admin' => "Admin", 'author' => "Author"],
            
            'data' => $this->transformer->transform($users, new UserTransformer(), 'collection'),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'next_page_url' => $users->nextPageUrl(),
            'prev_page_url' => $users->previousPageUrl(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem(),
            'links' => $users->linkCollection(),
        ];
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

    public function destroy(PageRequest $request,$id = null){
        $user = User::find($id);

        if(!$user){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        if($user->delete()){
            $this->response['status'] = true;
            $this->response['status_code'] = "USERS_DELETED";
            $this->response['msg'] = "User has been deleted.";
            $this->response['data'] = $this->transformer->transform($user, new UserTransformer(), 'item');
            $this->response_code = 200;

            goto callback;
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
