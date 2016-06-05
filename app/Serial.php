<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;

class Serial extends Model
{
	protected $table = 'serials';
    protected $fillable = array('*');
}
