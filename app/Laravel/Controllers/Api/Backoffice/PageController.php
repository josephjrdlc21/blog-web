<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Models\Page;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\Backoffice\PagesRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\Backoffice\PageTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str,Carbon;

class PageController extends Controller{
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

    public function store(PagesRequest $request){
        DB::beginTransaction();
        try{
            $page = new Page;
            $page->page = Str::lower($request->input('page'));
            $page->title = Str::upper($request->input('title'));
            $page->content = $request->input('content');
            $page->created_by = $this->data['auth']->id;
            $page->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "PAGE_CREATED";
            $this->response['msg'] = "New page has been created.";
            $this->response['data'] = $this->transformer->transform($page, new PageTransformer(), 'item');
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
}