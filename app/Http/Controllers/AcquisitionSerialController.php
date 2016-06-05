<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Acquisition_Serial;
use App\Serial;
use DateTime;
use Redirect;
use Session;
use Input;
use Illuminate\Support\Str;

class AcquisitionSerialController extends Controller
{
    /*Return View for Adding Serial Acquisition Details*/

    public function getserialno()
    {
        return view('vendor.serialno')
          ->with(array('title'=>'Add Serial Acquisition','message'=>'Add Serial Acquisition Details'));
    }

    /*Check if Serial No exists in the DB*/

    public function fetchserialno(Request $request)
    {
        $inp = $request->issn;
        $serial_no = DB::table('serials')
            ->where('serial_no','=',$inp)
            ->orWhere('issn','=',$inp)
            ->orWhere('title','=',$inp)
            ->pluck('serial_no');

        if($serial_no == 0){
            return Redirect::back()->withInput()
               ->with(array('flash_message'=>'Serial No / ISSN not in the database'));
        }

        else{
            Session::put('serial_no',$serial_no);
            return Redirect::to('acquisition/serial/add');
        }

    }


    /*Return view for adding acquisition details after adding the publication*/
    public function getSerialAcquisition()
    {
        $serial_no = Session::get('serial_no');
        Session::put('serial_no',$serial_no);
        $title = DB::table('serials')
            ->where('serial_no','=',$serial_no)
            ->pluck('title');

        return view('vendor.addacquisitionserial')
            ->with(array('title'=>'Add Serial Acquisition','serial_no'=>$serial_no,'serial_title'=>$title,'message'=>'Add Serial Acquisition Details'));
    }

    public function addSerialAcquisition(Request $request)
    {
        /*Check if Serial No exists in the DB*/
        $serial_no = Session::get('serial_no');
        $serial_no = DB::table('serials')
           ->where('serial_no','=',$serial_no)
           ->pluck('serial_no');

        if($serial_no == 0){
            return Redirect::back()->withInput()
                   ->with(array('flash_message','Serial No not in the database'));
        }

        /*Check if the Vendor exists in the DB*/
        $vendor = $request->vendortitle;
        $vendorid = DB::table('vendor')
            ->where('name','=',(string)$vendor)
            ->pluck('id');

        if($vendorid == 0){
            return Redirect::back()->withInput()
               ->with(array('flash_message'=>'Vendor not in the database'));
        }

        $serial = new Acquisition_Serial();
        $serial->transactionid = Str::quickRandom(8);
        $serial->serial_no = $serial_no;
        $serial->volume = $request->volume;
        $serial->issue_no = $request->issueno;
        $serial->month = $request->month;
        $serial->year = $request->year;
        $serial->vendorid = $vendorid;
        $serial->price = $request->price;
        $serial->quantity = $request->quantity;
        $serial->purchased_date = date('Y-m-d');
        $serial->save();

        return Redirect::to('cataloging/serial/add')
            ->with(array('flash_message'=>'Data Added Successfully'));
    }
}
