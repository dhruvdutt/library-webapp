<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;
use DB;

class Publication extends Model
{
	protected $table = 'publication';
  protected $fillable = array('*');
}
