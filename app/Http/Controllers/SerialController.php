<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;
use Session;
use App\Serial;
use App\Acquisition_Serial;

class SerialController extends Controller
{
  public function getAddSerial()
  {
    return view('serial.add')
        ->with(array('title'=>'Add Serial','message'=>'Add Serial'));
  }

  public function addSerial(Request $request)
  {
    #Check if Serial No already exists in the DB
    $serial_no = DB::table('serials')->lists('serial_no');

    if(in_array($request->serial_no,$serial_no))
    {
      return Redirect::back()->withInput()->with('flash_message','Serial No already exists in the Database');
    }

    #Check if ISSN already exists in the DB
    if($request->has('issn'))
    {
      $issn = DB::table('serials')->lists('issn');
      if(in_array($request->issn,$issn))
      {
        return Redirect::back()->withInput()->with('flash_message','ISSN already exists in the Database');
      }
    }

    #Add Serial Info
    $serial = new Serial();
    $serial->serial_no = $request->serial_no;
    $serial->issn = $request->issn;
    $serial->title = $request->title;
    $serial->frequency = $request->frequency;
    $serial->save();

    return Redirect::to('/cataloging/serial/find')
        ->with(array('flash_message'=>'Serial Information Added Successfully'));
  }

  #Updating Serial Information
  public function getUpdateSerial($serialno){
    $serial = Serial::where('serial_no',$serialno)
                      ->firstOrFail();

    #Put serial no in session to access it while updating the info
    Session::put('serial_no',$serialno);
    return view('serial.updateSerial')
        ->with(array('title'=>'Update Serial','serial'=>$serial));
  }

  #Handle Post Request for updating Serial information
  public function updateSerial(Request $request)
  {
      $serial_no = Session::get('serial_no');

      Session::forget('serial_no');

      Serial::where('serial_no', $serial_no)
              ->update(['serial_no'=>$request->serial_no,'issn' => $request->issn,'title'=>$request->title,'frequency'=>$request->frequency]);

      return Redirect::to('cataloging/serial/find')
         ->with(array('flash_message'=>'Serial Updated Successfully'));
  }

  public function getFindSerial()
  {
    /*Return View for Finding Serial*/
    return view('serial.findserial')
      ->with(array('title'=>'Find Serial','message'=>'Find Serial'));
  }

  /*Return view with publication details*/
  public function findSerial(Request $request)
  {
    /*Find publication*/
    $serial = Serial::where('title','LIKE','%'.$request->isbn.'%')
                           ->orWhere('issn','LIKE','%'.$request->isbn.'%')
                           ->orWhere('serial_no','LIKE','%'.$request->isbn.'%')
                           ->get();

    /*Return view with publication details*/
    return view('serial.showserial')->with(array('title'=>'Serial Details','serials'=>$serial));
  }
}
