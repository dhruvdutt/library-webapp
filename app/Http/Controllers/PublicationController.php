<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Session;
use Redirect;
use App\Publication;
use App\Acquisition;
use App\Accession;
use App\Http\Requests\BookValidation;
use App\Response;

class PublicationController extends Controller
{
  public function getaddPublication()
  {
    /*Return View for Adding Publication*/
    return view('publication.add')
           ->with(array('title'=>'Add Publication','message'=>'Add Book'));
  }

  /*Handle post request for adding data*/
  public function addPublication(BookValidation $request)
  {
    $isbn = DB::table('publication')
            ->lists('isbn');

    /*Check if ISBN already exists in the DB*/
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
    $publication->save();

    /*Put ISBN in Session so the it can be accessed while adding Acquisition details*/
    Session::put('isbn',$request->isbn);

    /*Redirect to add acquisition details*/
    return Redirect::to('/acquisition/publication/add')
            ->with(array('flash_message'=>'Book Added Successfully','message'=>'Generate Numbers'));
  }

  /*Return publication details to update*/
  public function getUpdatePublication($isbn)
  {
    /*Check publication exists or not*/
    $publication = Publication::where('isbn',$isbn)
                                ->firstOrFail();

    /*Put isbn in session to access it while updating publication details*/
    Session::put('isbn',$isbn);

    /*Return view with publication details to update*/
    return view('publication.update')
        ->with(array('title'=>'Update Publication','publication'=>$publication,'message'=>'Update Publication'));
  }

  /*Update Publication Details*/
  public function updatePublication(Request $request)
  {
    /*Get isbn from the session and then flush the isbn session variable*/
    $isbn = Session::get('isbn');
    Session::forget('isbn');

    /*Update publication details*/
    Publication::where('isbn', $isbn)
                 ->update(['title' => $request->title,'author'=>$request->author,'publisher'=>$request->publisher]);

    /*Redirect after successfull updation of publication*/
    return Redirect::to('/cataloging/publication/find')
           ->with(array('flash_message'=>'Book Updated Successfully'));
  }

  /*Return View to update accession status*/
  public function getcontrolAccession()
  {
      return view('publication.getcontrolAccession')
        ->with(array('title'=>'Control Accession','message'=>'Find Accession'));
  }

  /*Return accession details to update*/
  public function controlAccession(Request $request)
  {
    $accession_no = $request->accession;

    /*Check if accesion exists in the DB*/
    Accession::where('accession_no',$accession_no)
             ->firstOrFail();

    /*Fetch Data from DB*/
    $accession = DB::table('accession')
                   ->join('publication', 'publication.isbn', '=', 'accession.isbn')
                   ->join('circulation', 'accession.accession_no', '=', 'circulation.accession_no')
                   ->join('users', 'circulation.readerid', '=', 'users.id')
                   ->where('accession.accession_no',$accession_no)
                   ->select('publication.isbn','publication.title','publication.author', 'accession.*','users.id','users.name','users.year')
                   ->get();

    /*Put accession no. in session to access it while updating status*/
    Session::put('accession_no',$accession_no);

    /*Return view with data to update accession status*/
    return view('publication.controlAccession')
        ->with(array('title'=>'Control Accession','accession'=>$accession[0],'message'=>'Update Status'));
  }

  /*Update Status of Book*/
  public function updateAccession(Request $request)
  {
      $updatables = ['available','missing','weedout'];
      foreach($updatables as $updatable)
      {
        if($request->status != $updatable)
        {
          return Redirect::back()->with('flash_message','Invalid Status');
        }
        else
        {
          /*Get accession from the session and then flush the accession session variable*/
          $accession_no = Session::get('accession_no');
          Session::forget('accession_no');

          /*Update accession status*/
          Accession::where('accession_no', $accession_no)
                    ->update(['status' => $request->status]);

          /*Redirect after successfull updation of accesion status*/
          return Redirect::to('publication/accession')
              ->with(array('flash_message'=>'Updated Successfully'));
        }
      }
  }

  /*Find Publication*/
  public function getFindPublication()
  {
    /*Return View for Finding Publication*/
    return view('publication.findpublication')
      ->with(array('title'=>'Find Publication','message'=>'Find Publication'));
  }

  /*Return view with publication details*/
  public function findPublication(Request $request)
  {
    $this->validate($request,[
      'publication_isbn' => 'required'
    ]);
    /*Find publication*/
    $publication = Publication::where('title','LIKE','%'.$request->publication_isbn.'%')
                                ->orWhere('isbn','LIKE','%'.$request->publication_isbn.'%')
                                ->get();

    /*Return view with publication details*/
    return view('publication.showpublication')->with(array('title'=>'Publication Details','publications'=>$publication,'message'=>'Publication Details'));
  }

  public function getAccession()
  {
    $numbers = DB::table('accession')
              ->orderBy('accession_no', 'desc')
              ->select('accession_no','class_no')
              ->first();
    return new Response(200,'OK',$numbers);
  }
}
