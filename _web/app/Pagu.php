<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    protected $table = 'pagu';

	protected $fillable = ['tahun', 'pagu', 'sisa' ];
}
