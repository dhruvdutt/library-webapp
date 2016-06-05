<?php

namespace App\Http\Controllers;

use App\Circulation;
use App\Publication;
use App\FineCollection;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;
use DB;
use App\IssueRestriction;
use DateTime;

class home extends Controller
{

    /*Return Home Page*/
    public function index()
    {
        return view('welcome')
            ->with(array('title'=>'Welcome','welcome_message'=>'Welcome to CA Library'));
    }

    /*Return page based on user rights*/
    public function main()
    {
        if(Auth::user()->type == 'admin')
        {
          Session::put('total_pubication',Publication::count());
          Session::put('total_circulation',Circulation::count());
          Session::put('total_fine',FineCollection::sum('fine_amount'));
          return view('layouts.nav')
                 ->with(array('title'=>'Home','message'=>'Welcome'));
        }
        else
        {
            $records = Circulation::where('readerid',Auth::user()->id)->get();
            foreach ($records as $record)
            {
              $publication = DB::table('accession')
                               ->join('publication', 'publication.isbn', '=', 'accession.isbn')
                               ->where('accession_no',$record->accession_no)
                               ->select('publication.isbn','publication.title','publication.author')
                               ->get();

             $record->isbn = $publication[0]->isbn;
             $record->title = $publication[0]->title;
             $record->author = $publication[0]->author;
             if($record->returneddate == null)
             {
               $totaldays = IssueRestriction::where('for',Auth::user()->year)
                                             ->firstOrFail();

               $returndate = DateTime::createFromFormat('Y-m-d',gmdate('Y-m-d',strtotime($record->returndate)));
               $returneddate = DateTime::createFromFormat('Y-m-d',date('Y-m-d'));
               $record->fine = Circulation::calculateFine($returneddate,$returndate,$totaldays->fine);
             }
            }
            return view('layouts.student')
                   ->with(array('title'=>'Home','message'=>'Issue Records','records'=>$records,'reader'=>Auth::user()));
        }
    }
}
