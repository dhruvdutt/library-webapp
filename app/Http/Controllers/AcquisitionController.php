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
use App\Publication;
use App\Vendor;

class AcquisitionController extends Controller
{
    /*Return View for Adding Acquisition Details*/
    public function getisbn()
    {
      return view('vendor.isbn')
             ->with(array('title'=>'Add Acquisition','message'=>'Find Book'));
    }

    public function fetchisbn(Request $request)
    {
      $isbn = $request->publication_isbn;

      /*Check if ISBN exists in the DB*/
      $publication = Publication::where('isbn',$isbn)
                                  ->orWhere('title',$isbn)
                                  ->select('isbn')
                                  ->firstOrFail();

      /*If the ISBN exists in the DB put it into the session to access while generating numbers*/
      Session::put('isbn',$publication->isbn);
      return Redirect::to('acquisition/publication/add');
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
    	$publication = Publication::where('isbn',$isbn)
                                  ->select('isbn')
                                  ->firstOrFail();

      /*Check if the Vendor exists in the DB*/
      $vendor = Vendor::where('name',$request->vendortitle)->firstOrFail();

      /*Check if Accession and Class number already exist in the Databse*/
      $accession_no = DB::table('accession')
                      ->lists('accession_no');
      $class_no = DB::table('accession')
                  ->lists('class_no');

      $accession = Input::get('accession');
      $class = Input::get('class');

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
      $quantity = $request->quantity;
      for($i=0;$i<$quantity;$i++)
      {
        $data = new Accession();
        $data->transactionid = Str::quickRandom(8);
        $data->isbn = $publication->isbn;
        $data->accession_no = $accession[$i];
        $data->class_no = $class[$i];
        $data->status = 'available';
        $data->save();
      }

      /*Insert Acquisition data into DB*/
      $acquisition = new Acquisition;
      $acquisition->transactionid = Str::quickRandom(6);
      $acquisition->isbn = $publication->isbn;
      $acquisition->vendorid = $vendor->id;
      $acquisition->price = $request->price;
      $acquisition->quantity = $quantity;
      $acquisition->cd = $request->cd;
      $acquisition->volume = $request->volume;
      $acquisition->purchased_date = date('Y-m-d');
      $acquisition->save();

      return Redirect::to('/cataloging/publication/find')
          ->with(array('flash_message'=>'Data Added Successfully'));
    }
}
