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
            'source' => $user->source,
            'filename' => $user->filename,
            'path' => $user->path,
            'directory' => $user->directory,
	    ];
	}
}