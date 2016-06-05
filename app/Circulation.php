<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    protected $table = 'circulation';

    /*Calculate fine*/
    public static function calculateFine($returneddate,$returndate,$fine)
    {
      $fine_days = date_diff($returneddate,$returndate)->format('%r%a');
      if($fine_days < 0)
      {
        return abs($fine_days)*$fine;
      }
      return null;
    }
}
