<?php 

namespace App\Laravel\Transformers\Backoffice;

use App\Laravel\Models\Category;

use League\Fractal\TransformerAbstract;

use App\Laravel\Traits\ResponseGenerator;

use Str,Carbon;

class CategoryTransformer extends TransformerAbstract{
	use ResponseGenerator;

    public function __construct(){
    
    }

	public function transform(Category $category){
	    return [
	     	'id' => $category->id,
			'name' => $category->name,
			'created_at' => Carbon::parse($category->created_at)->format('d/m/Y h:i A'),
            'updated_at' => Carbon::parse($category->updated_at)->format('d/m/Y h:i A')
	    ];
	}
}