<?php

namespace App\Http\Controllers;

use App\Accession;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Input;
use Auth;
use Redirect;
use App\Publication;
use App\Acquisition;
use Datetime;
use App\Http\Requests\BookValidation;
use App\Http\Requests\UpdateBookValidation;
use Session;

class PublicationController extends Controller
{
      /*Return View for Adding Publication*/
      public function getaddPublication()
      {
          return view('publication.add')
              ->with(array('title'=>'Add Publication','message'=>'Add Book'));
      }

      /*Handle post request for adding data*/
      public function addPublication(BookValidation $request)
      {
        /*Check if ISBN already exists in the DB*/
        $isbn = DB::table('publication')
                ->lists('isbn');
        if(in_array($request->isbn,$isbn))
        {
            return Redirect::back()->withInput()->with('flash_message','Book already exists in the Database');
        }
        /*Add Publication Info*/
        $publication = new Publication();
        $publication->isbn = $request->isbn;
        $publication->title = $request->title;
        $publication->author = $request->author;
        $publication->publisher = $request->publisher;
        /*Put ISBN in Session so the it can be accessed while adding Acquisition details*/
        Session::put('isbn',$request->isbn);
        $publication->save();
        return Redirect::to('/acquisition/add')
                ->with(array('flash_message'=>'Book Added Successfully','message'=>'Generate Numbers'));
    }

    /*Return View for Updating Publication*/
    public function getupdatePublication()
    {
        return view('publication.updatePublicationInput')
          ->with(array('title'=>'Update Publication','message'=>'Update Publication'));
    }

    /*Return View with data to Update Publication Details*/
    public function updatePublication(Request $request)
    {
            $isbn = $request->isbn;
            $publication = new Publication();
            $publication = DB::table('publication')
                ->where('isbn','=',$isbn)
                ->orWhere('title','=',$isbn)->get();

            /*Check if book exists in the DB*/
            if($publication == null)
            {
                return Redirect::back()
                    ->with(array('flash_message'=>'No Record with this ID or title'));
            }
            else
            {
                #Put isbn in session to access it while updating the info
                Session::put('isbn',$publication[0]->isbn);
                return view('publication.updatePublication')
                    ->with(array('title'=>'Update Book','publication'=>$publication[0]));
            }
    }

    /*Handle Post Request for updating Publication Details*/
    public function updatePub(BookValidation $request)
    {
        $isbn = Session::get('isbn');
        Session::forget('isbn');
        DB::table('Publication')
            ->where('isbn', $isbn)
            ->update(['title' => $request->title,'author'=>$request->author,'publisher'=>$request->publisher]);
        return Redirect::to('publication/update')
               ->with(array('flash_message'=>'Book Updated Successfully'));

    }

    /*Return View to update status*/
    public function getcontrolAccession()
    {
        return view('publication.getcontrolAccession')
          ->with(array('title'=>'Control Accession','message'=>'Update Status'));
    }

    /*Return View with data to Update Publication Details*/
    public function controlAccession(Request $request)
    {
        $accession_no = (string)$request->accession;
        $accession = DB::table('accession')
            ->where('accession_no','=',$accession_no)->get();

        /*Check if accesion no exists in the DB*/
        if($accession == null)
        {
            return Redirect::back()
                ->with(array('flash_message'=>'No Record with this Accession'));
        }
        else
        {
            Session::put('accession_no',$accession_no);
            return view('publication.controlAccession')
                ->with(array('title'=>'Control Accession','accession'=>$accession[0]));
        }
    }

    /*Update Status of Book*/
    public function updateAccession(Request $request)
    {
        $accession_no = Session::get('accession_no');
        Session::forget('accession_no');
        $status = $request->status;
        DB::table('accession')
            ->where('accession_no', $accession_no)
            ->update(['status' => $status]);
        return Redirect::to('publication/accession')
            ->with(array('flash_message'=>'Updated Successfully'));
    }
}
