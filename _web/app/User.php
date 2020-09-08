<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ps_id', 'name', 'email', 'password', 'nim', 'prodi', 'telepon',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleuser()
    {
        return $this->belongsTo('App\RoleUser', 'user_id');
    }

    public function proposal()
    {
        return $this->hasMany('App\Proposal', 'user_id');
    }

    public function ps()
    {
        return $this->belongsTo('App\Prodi', 'ps_id');
    }
}
