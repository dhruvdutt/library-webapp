<?php

namespace App\Http\Controllers;

use App\Circulation;
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

class CirculationController extends Controller
{
    /*Return View for Checking Pending issues*/
    public function getissuePublication()
    {
      return view('Circulation.pending')
          ->with(array('title'=>'Issue Publication','message'=>'Issue Publication'));
    }

    /*Return View for Issue Publication*/
    public function issue($id){
      $issuedate = date('Y-m-d');
      /*Put Reader ID in session to access in issue publication*/
      Session::put('readerid',$id);
      return view('Circulation.issue')
          ->with(array('title'=>'Issue Publication','issuedate'=>$issuedate,'readerid'=>$id));
    }

    /*Issue Publication*/
    public function issuePublication(Request $request)
    {
      $accession_no = $request->accession_no;
      $accession = DB::table('accession')->select('status')->where('accession_no','=',$accession_no)->get();
      
      /*Check if accession no exists in the DB*/
      if(sizeof($accession) == 0)
      {
        return Redirect::back()->withInput()->with('flash_message','Accession Number Does Not Exist in the DB');
      }
      /*Check if book is available for issue*/
      if($accession[0]->status != 'available')
      {
        return Redirect::back()->withInput()->with('flash_message','The Status of Book with this number is '.$accession[0]->status);
      }

      $issuedate = date('Y-m-d');
      $circulation = new Circulation();
      $circulation->transactionid = Str::quickRandom(6);
      $circulation->accession_no = $request->accession_no;
      $circulation->readerid = Session::get('readerid');
      Session::forget('readerid');
      $circulation->issuedate = $request->issuedate;
      $circulation->returndate = $request->returndate;
      DB::table('accession')
          ->where('accession_no', $request->accession_no)
          ->update(['status' => 'notavailable']);
      $circulation->save();
      return Redirect::to('publication/issue')
             ->with(array('flash_message'=>'Issued Successfully'));
    }

    /*Return View for Return Publication*/
    public function getreturnPublication()
    {
      return view('Circulation.return')
          ->with(array('title'=>'Return Publication','message'=>'Return Publication'));
    }

    /*Calcualte Fine send view to return publication*/
    public function returnPublication(Request $request)
    {
            $readerid = $request->readerid;
            $accession = $request->accession_no;
            $values = DB::table('circulation')
                ->where('readerid','=',$readerid)
                ->where('accession_no','=',$accession)
                ->orderBy('issuedate','desc')
                ->get();
            $type = DB::table('users')
                ->select('type')
                ->where('id','=',$readerid)
                ->get();
            /*If user is a faculty then fine will be 0*/
            if($type[0]->type != 'faculty')
            {
              for($i=0;$i<sizeof($values);$i++)
              {
                  $returndate = strtotime($values[0]->returndate);
                  $return = gmdate('Y-m-d',$returndate);
                  $returneddate = date('Y-m-d');
                  $myDateTime = DateTime::createFromFormat('Y-m-d',$return);
                  $myDate = DateTime::createFromFormat('Y-m-d',$returneddate);
                  $fine = date_diff($myDate,$myDateTime)->format('%d');
                  if($fine > 7)
                  {
                      $fine = ($fine)* 2;
                  }
                  else{
                      $fine = 0;
                  }
                  $values[$i]->returneddate = $returneddate;
                  $values[$i]->fine = $fine;
                  Session::put(array('returneddate'=>$values[$i]->returneddate,'fine'=>$values[$i]->fine));
                  Session::put('readerid',$readerid);
                  Session::put('accession_no',$accession);
              }
              return view('Circulation.returned')
                ->with(array('title'=>'Return','records'=>$values));
            }
            else
            {
              for($i=0;$i<sizeof($values);$i++)
              {
                  $returneddate = date('Y-m-d');
                  $values[$i]->returneddate = $returneddate;
                  $values[$i]->fine = 0;
                  Session::put(array('returneddate'=>$values[$i]->returneddate,'fine'=>$values[$i]->fine));
                  Session::put('readerid',$readerid);
                  Session::put('accession_no',$accession);
              }
              return view('Circulation.returned')
                ->with(array('title'=>'Return','records'=>$values));
            }
    }

    /*Return Publication*/
    public function returnedPublication(Request $request)
    {
        DB::table('circulation')
            ->where('readerid', Session::get('readerid'))
            ->where('accession_no',Session::get('accession_no'))
            ->update(['returneddate' => Session::get('returneddate'),'fine'=>Session::get('fine'),'note'=>$request->note]);
        DB::table('accession')
            ->where('accession_no',Session::get('accession_no'))
            ->update(['status' => 'available']);
        
        Session::forget('readerid');
        Session::forget('accession_no');
        Session::forget('returneddate');
        Session::forget('fine');

        return Redirect::to('publication/return')
            ->with(array('flash_message'=>'Returned Successfully'));
    }

    /*Get Pending Issue Details of the User*/
    public function getPendingdetails($id)
    {
      $reader = DB::table('users')->select('id','name','department','year')->where('id','=',$id)->get();
      if(sizeof($reader) == 0)
      {
        return (json_encode(['status'=>404,'message'=>"Reader Not Found"]));
      }
      $publications = DB::table('circulation')
          ->where('readerid','=',$reader[0]->id)->get();
      $counter = 0;
      for($i=0 ;$i<sizeof($publications); $i++)
      {
        if($publications[$i]->returneddate == null)
        {
          $counter = $counter + 1;
        }
      }
      $result = ['id'=>$reader[0]->id,'name'=>$reader[0]->name,'department'=>$reader[0]->department,'year'=>$reader[0]->year,'pending'=>$counter];
      return json_encode($result);  
    }
    
}
