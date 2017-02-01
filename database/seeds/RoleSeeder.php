<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    protected $roles = [
    	'admin',
    	'supervisor',
    	'buyer',
    	'seller',
    	'buyer-and-seller',
    ];

    public function run()
    {
        foreach ($this->roles as $role) {
        	$r = new App\Role;
        	$r->name = $role;
        	$r->save();
        }
    }
}
