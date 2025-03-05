<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\User;

use League\Fractal\TransformerAbstract;

use App\Laravel\Traits\ResponseGenerator;

use Str,Carbon;

class UserTransformer extends TransformerAbstract{
	use ResponseGenerator;

    public function __construct(){
    
    }

	public function transform(User $user) {
	    return [
	     	'id' => $user->id,
			'name' => $user->name,
			'firstname' =>  $user->firstname,
			'middlename' =>  $user->middlename,
			'lastname' =>  $user->lastname,
			'suffix' =>  $user->suffix,
            'username' => $user->username,
			'email' => $user->email,
            'type' => $user->type,
            'status' => $user->status,
            'last_login_at' => $user->last_login_at ? Carbon::parse($user->last_login_at)->format('d/m/Y h:i A') : null,
			'created_at' => Carbon::parse($user->created_at)->format('d/m/Y h:i A'),
            'updated_at' => Carbon::parse($user->updated_at)->format('d/m/Y h:i A')
	     ];
	}
}