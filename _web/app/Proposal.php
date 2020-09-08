<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';

	protected $fillable = ['user_id', 'organisasi', 'kegiatan', 'tanggal', 'tempat', 
							'anggaran_a', 'anggaran_b', 'dana', 'status', 'file', 'lpj'];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function catatan()
	{
		return $this->hasMany('App\Catatan', 'proposal_id');
	}

}
