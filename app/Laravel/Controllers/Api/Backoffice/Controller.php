<?php

namespace App\Laravel\Controllers\Api\Backoffice;

use App\Laravel\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Route;
class Controller extends BaseController{
	protected $data;

	public function __construct(){
		self::set_loggedin_user();
    }

	public function set_loggedin_user(){
		if (auth('backoffice')->user()) {
        	$this->data['auth'] = auth('backoffice')->user();
		}
	}
}