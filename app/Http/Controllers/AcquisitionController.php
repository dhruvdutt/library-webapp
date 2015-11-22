<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Acquisition;
use App\Accession;
use DateTime;
use Redirect;
use Session;
use Input;
use Illuminate\Support\Str;

class AcquisitionController extends Controller
{
    /*Return View for Adding Acquisition Details*/
    public function getisbn()
    {
        return view('vendor.isbn')
          ->with(array('title'=>'Add Acquisition','message'=>'Add Acquisition Details'));
    }

    /*Check if ISBN exists in the DB*/
    public function fetchisbn(Request $request)
    {
        $isbn = $request->isbn;
        $isbndb = DB::table('publication')
               ->where('isbn','=',$isbn)
               ->orWhere('title','=',$isbn)
               ->pluck('isbn');
        if($isbndb == 0)
        {
            return Redirect::back()->withInput()
                   ->with(array('flash_message','ISBN not in the database'));
        }
        else
        {
            Session::put('isbn',$isbndb);
            return Redirect::to('acquisition/add');
        }

    }

    /*Return view for adding acquisition details after adding the publication*/
	public function getAcquisition()
    {
        $isbn = Session::get('isbn');
        Session::put('isbn',$isbn);
        return view('vendor.addacquisition')
                    ->with(array('title'=>'Add Acquisition','isbn'=>$isbn,'message'=>'Add Acquisition Details'));
    }

    public function addAcquisition(Request $request)
    {
    	/*Check if ISBN exists in the DB*/
    	$isbn = Session::get('isbn');
    	$isbn = DB::table('publication')
               ->where('isbn','=',$isbn)->pluck('isbn');
        if($isbn == 0)
        {
            return Redirect::back()->withInput()
                   ->with(array('flash_message','ISBN not in the database'));
        }

        /*Check if the Vendor exists in the DB*/
        $vendor = $request->vendortitle;
        $vendorid = DB::table('vendor')
                ->where('name','=',(string)$vendor)->pluck('id');
        if($vendorid == 0)
        {
            return Redirect::back()->withInput()
                   ->with(array('flash_message','Vendor not in the database'));
        }

        $quantity = $request->quantity;

        /*Check if Accession and Class number already exist in the Databse*/
        $accession_no = DB::table('accession')
                ->lists('accession_no');
        $class_no = DB::table('accession')
                ->lists('class_no');


        for($i=1;$i<=$quantity;$i++)
        {
            $accession[$i-1] = (integer)Input::get('accession'.(string)$i);
            $class[$i-1] = (integer)Input::get('classno'.(string)$i);
        }

        for($i=0;$i<sizeof($accession_no);$i++)
        {
            for($j=0;$j<sizeof($accession);$j++)
            {
                if(in_array($accession[$j], $accession_no))
                {
                    return Redirect::back()->withInput()->with('flash_message','Numbers already exist in the Database');
                }
            }
        }

        /*Flush the isbn variable from the session after all validations are done*/
        Session::forget('isbn');

        /*Insert Accession and Class numbers based on the quantity*/
        for($i=1;$i<=$quantity;$i++)
        {
            $data = new Accession();
            $data->transactionid = Str::quickRandom(8);
            $data->isbn = $isbn;
            $data->accession_no = Input::get('accession'.(string)$i);
            $data->class_no = Input::get('classno'.(string)$i);
            $data->status = 'available';
            $data->save();
        }

        /*Insert Acquisition data into DB*/
        $acquisition = new Acquisition;
        $acquisition->transactionid = Str::quickRandom(6);
        $acquisition->isbn = $isbn;
        $acquisition->vendorid = $vendorid;
        $acquisition->price = $request->price;
        $acquisition->quantity = $quantity;
        $acquisition->cd = $request->cd;
        $acquisition->volume = $request->volume;
        $acquisition->purchased_date = date('Y-m-d');
        $acquisition->save();

        return Redirect::to('publication/add')
            ->with(array('flash_message'=>'Data Added Successfully'));
    }

    /*Return last accession no and class no to ajax call*/
    public function getAccession()
    {
        $data = DB::table('accession')->select('accession_no','class_no')
                    ->orderBy('accession_no', 'desc')
                    ->get();
        return $data;
    }
}
