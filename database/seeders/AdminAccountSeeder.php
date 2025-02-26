<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Laravel\Models\User;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->orWhere('username', 'master_admin')->first();

        if(!$admin){
            $account = new User;
            $account->firstname = 'MASTER';
            $account->lastname = 'ADMIN';
            $account->username = 'master_admin';
            $account->type = 'admin';
            $account->status = 'active';
            $account->email = 'admin@gmail.com';
            $account->password = bcrypt('admin');
            $account->save();
        }
    }
}
