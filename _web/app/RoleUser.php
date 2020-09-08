<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

	protected $fillable = ['user_id', 'role_id'];

	public function user()
	{
		return $this->hasMany('App\User', 'user_id');
	}

	public function roles()
	{
		return $this->hasMany('App\Role', 'role_id');
	}
}
