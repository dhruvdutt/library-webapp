<?php

namespace App\Http\Controllers;

use App\Circulation;
use App\Accession;
use App\Publication;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Redirect;
use DB;
use DateTime;
use Illuminate\Support\Str;
use Session;
use App\IssueRestriction;
use App\User;
use App\FineCollection;

class CirculationController extends Controller
{

    /*Issue Publication*/
    public function issuePublication(Request $request)
    {
      $accession_no = $request->accession_no;

      /*Check if accession no exists in the DB*/
      $accession = Accession::where('accession_no','=',$accession_no)
                              ->select('status')
                              ->get();

      /*Check if book is available for issue*/
      if(sizeof($accession) == 0)
      {
        return new Response(400,'Accession Number does not exists');
      }

      /*Check if book is available for issue*/
      if($accession[0]->status != 'available')
      {
        return new Response(400,'The Status of Book with this number is '.strtoupper($accession[0]->status));
      }

      $issuedate = date('Y-m-d');
      $returndate = Session::get('returndate');
      Session::forget('returndate');

      $circulation = new Circulation();
      $circulation->transactionid = Str::quickRandom(6);
      $circulation->accession_no = $request->accession_no;
      $circulation->readerid = $request->readerid;
      $circulation->issuedate = $issuedate;
      $circulation->returndate = $returndate;
      $circulation->note = $request->note;

      Accession::where('accession_no', $request->accession_no)
                 ->update(['status' => 'notavailable']);

      $circulation->save();

      return new Response(200,'Issued Successfully');
    }

    /*Return Publication*/
    public function returnPublication(Request $request)
    {
       $fine = null;
       $note = null;
       if(!is_null($request->fine))
        {
          $fine = $request->fine;
          $finecollection = new FineCollection;
          $finecollection->transactionid = Str::quickRandom(6);
          $finecollection->readerid = $request->readerid;
          $finecollection->fine_for = 'late return';
          $finecollection->fine_amount = $fine;
          $finecollection->date = date('Y-m-d');
          $finecollection->save();
        }
        if(!is_null($request->note))
        {
          $note = $request->note;
        }

        Circulation::where('transactionid', $request->transactionid)
                    ->update(['returneddate' => date('Y-m-d'),'fine'=>$fine,'note'=>$note]);

         Accession::where('accession_no',$request->accession_no)
                   ->update(['status' => 'available']);

        return new Response(200,'OK');
    }

    /*Get Pending Issue Details of the User*/
    public function getPendingdetails($id)
    {
      $reader = User::where('id',$id)
                      ->select('id','name','department','year')
                      ->firstOrFail();

      $circulations = Circulation::where('readerid',$id)
                      ->get();

      /*Calculate Fine*/
      $totaldays = IssueRestriction::where('for',$reader->year)
                                    ->firstOrFail();

      foreach ($circulations as $c)
      {
        if($c->returneddate == null)
        {
          $returndate = date_create($c->returndate);
          $returneddate = date_create(date('Y-m-d'));
          $c->fine = Circulation::calculateFine($returneddate,$returndate,$totaldays->fine);
        }
        $publication = DB::table('accession')
                         ->join('publication', 'publication.isbn', '=', 'accession.isbn')
                         ->where('accession_no',$c->accession_no)
                         ->select('publication.isbn','publication.title','publication.author')
                         ->get();
       $c->isbn = $publication[0]->isbn;
       $c->title = $publication[0]->title;
       $c->author = $publication[0]->author;
      }
     $circulations = new \Illuminate\Pagination\Paginator($circulations, 5);
#return $circulations;
      /*If number of books issued are more than assigned then do not issue*/
      $circulation = Circulation::where('returneddate',null)->where('readerid',$id)->get();
      if(sizeof($circulation) >= $totaldays->books_for_issue)
      {
        $issue = false;
        $error_message = sizeof($circulation).' book/s pending to be returned';
      }
      else
      {
        $issue = true;
        $error_message = '';
      }

      /*Assign Issue and Return Date*/
      $issuedate = date('Y-m-d');
      $returndate = date('Y-m-d',strtotime('+'.$totaldays->days.' days'));

      Session::put('returndate',$returndate);

      return view('Circulation.issue')
            ->with(array('title'=>'Issue Publication','issuedate'=>$issuedate,'returndate'=>$returndate,'circulations'=>$circulations,'reader'=>$reader,'issue'=>$issue,'error_message'=>$error_message,'message'=>'Issue Publication'));
    }

    public function getPublicationInfo($accession_no)
    {
      $accession = Accession::where('accession_no',$accession_no)
                 ->select('isbn')
                 ->get();

      $publication = Publication::where('isbn',$accession[0]->isbn)
                   ->select('isbn','title','author')
                   ->get();

      return new Response(200,'OK',$publication);
    }

}
