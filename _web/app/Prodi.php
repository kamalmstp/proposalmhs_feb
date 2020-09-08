<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

	protected $fillable = ['nama'];


	public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
