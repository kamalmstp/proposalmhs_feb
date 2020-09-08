<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $table = 'catatan';

	protected $fillable = ['proposal_id', 'catatan' ];

	public function proposal()
	{
		return $this->belongsTo('App\Proposal', 'proposal_id');
	}
}
