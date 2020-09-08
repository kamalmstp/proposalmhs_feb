<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

	protected $fillable = ['name', 'display_name', 'description'];

	public function roles()
	{
		return $this->belongsTo('App\RoleUser', 'role_id');
	}
}
