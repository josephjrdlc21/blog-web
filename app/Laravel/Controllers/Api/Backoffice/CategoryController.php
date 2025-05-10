<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Models\Category;

use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Api\Backoffice\CategoryRequest;

use App\Laravel\Traits\ResponseGenerator;

use App\Laravel\Transformers\Backoffice\CategoryTransformer;
use App\Laravel\Transformers\TransformerManager;

use DB,Str,Carbon;

class CategoryController extends Controller{
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

        $first_record = Category::orderBy('created_at', 'ASC')->first();
        $start_date = $request->get('start_date') ?? ($first_record?->created_at?->format('Y-m-d') ?? now()->startOfMonth()->format('Y-m-d'));

        $this->data['start_date'] = Carbon::parse($start_date)->format("Y-m-d");
        $this->data['end_date'] = Carbon::parse($request->get('end_date', now()))->format("Y-m-d");

        $categories = Category::where(function ($query) {
            if(strlen($this->data['keyword']) > 0){
                $query->whereRaw("LOWER(name) LIKE '%{$this->data['keyword']}%'");
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
        ->orderBy('created_at','DESC')
        ->paginate($this->per_page);

        $this->response['status'] = true;
        $this->response['status_code'] = "CATEGORIES_LIST";
        $this->response['msg'] = "List of Categories";
        $this->response['data'] = [
            'start_date' => $this->data['start_date'],
            'end_date' => $this->data['end_date'],
            'keyword' => $this->data['keyword'],
            'data' => $this->transformer->transform($categories, new CategoryTransformer(), 'collection'),
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage(),
            'per_page' => $categories->perPage(),
            'total' => $categories->total(),
            'next_page_url' => $categories->nextPageUrl(),
            'prev_page_url' => $categories->previousPageUrl(),
            'from' => $categories->firstItem(),
            'to' => $categories->lastItem(),
            'links' => $categories->linkCollection(),
        ];
        $this->response_code = 200;

        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function store(CategoryRequest $request){
        DB::beginTransaction();
        try{
            $category = new Category;
            $category->name = Str::upper($request->input('category'));
            $category->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "CATEGORY_CREATED";
            $this->response['msg'] = "New category has been created.";
            $this->response['data'] = $this->transformer->transform($category, new CategoryTransformer(), 'item');
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
        $category = Category::find($id);

        if(!$category){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        $this->response['status'] = true;
        $this->response['status_code'] = "EDIT_CATEGORY";
        $this->response['msg'] = "Edit Category Details";
        $this->response['data'] = $this->transformer->transform($category, new CategoryTransformer(), 'item');
        $this->response_code = 200;
        
        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }

    public function update(CategoryRequest $request,$id = null){
        $category = Category::find($id);

        if(!$category){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        DB::beginTransaction();
        try{
            $category->name = Str::upper($request->input('category'));
            $category->save();

            DB::commit();

            $this->response['status'] = true;
            $this->response['status_code'] = "CATEGORY_UPDATED";
            $this->response['msg'] = "Category has been updated.";
            $this->response['data'] = $this->transformer->transform($category, new CategoryTransformer(), 'item');
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
        $category = Category::find($id);

        if(!$category){
            $error = $this->not_found_error();
            return response()->json($error['body'], $error['code']);
        }

        if($category->delete()){
            $this->response['status'] = true;
            $this->response['status_code'] = "CATEGORY_DELETED";
            $this->response['msg'] = "Category has been deleted.";
            $this->response['data'] = $this->transformer->transform($category, new CategoryTransformer(), 'item');
            $this->response_code = 200;

            goto callback;
        }

        callback:
        return response()->json($this->api_response($this->response), $this->response_code);
    }
}