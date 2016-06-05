<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;

class OldRecordsController extends Controller
{
      public function getOldRecords($year_enrolled,$year)
      {
        $valid = ['tybca','symsc'];
        foreach($valid as $v)
        {
          if($year == $v)
          {
            $records = User::onlyTrashed()
                    ->where('year_enrolled', $year_enrolled)
                    ->where('year', $year)
                    ->select('id','name','department','year','year_enrolled')
                    ->get();
          return view('oldrecords.oldrecords')
                 ->with(['title'=>'Old Records','records'=>$records,'message'=>'Old Records']);
          }
        }
        return Redirect::to('/home')
                       ->with('flash_message','No Records');
      }
}
