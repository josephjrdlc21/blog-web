<?php 

namespace App\Laravel\Transformers\Backoffice;

use App\Laravel\Models\User;

use League\Fractal\TransformerAbstract;

use App\Laravel\Traits\ResponseGenerator;

use Str,Carbon;

class ProfileTransformer extends TransformerAbstract{
	use ResponseGenerator;

    public function __construct(){
    
    }

	public function transform(User $user){
	    return [
	     	'firstname' =>  $user->firstname,
			'middlename' =>  $user->middlename,
			'lastname' =>  $user->lastname,
			'suffix' =>  $user->suffix,
            'username' => $user->username,
			'email' => $user->email,
			'avatar' => $user->directory ? $this->image_response($user->directory, $user->path, $user->filename) : $this->image_response(),
	    ];
	}
}