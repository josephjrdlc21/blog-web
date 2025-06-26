<?php 

namespace App\Laravel\Transformers\Backoffice;

use App\Laravel\Models\Page;

use League\Fractal\TransformerAbstract;

use App\Laravel\Traits\ResponseGenerator;

use Str,Carbon;

class PageTransformer extends TransformerAbstract{
	use ResponseGenerator;

    public function __construct(){
    
    }

	public function transform(Page $page){
	    return [
	     	'id' => $page->id,
			'page' => $page->page,
            'title' => $page->title,
			'content' => $page->content,
			'created_at' => Carbon::parse($page->created_at)->format('d/m/Y h:i A'),
            'updated_at' => Carbon::parse($page->updated_at)->format('d/m/Y h:i A')
	    ];
	}
}