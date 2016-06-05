<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\IssueRestriction;
use App\Response;
use App\FineCollection;
use App\User;

class IssueRestrictionController extends Controller
{
    public function getrestrictionData()
    {
        return new Response(200,'OK',IssueRestriction::all());
    }

    public function updateRestriction(Request $request,$year)
    {
      $updatables = ['days','books_for_issue','fine'];
      foreach ($updatables as $updatable)
      {
          if($request->has($updatable))
          {
              IssueRestriction::where('for','=',$year)
                          ->update([$updatable=>$request->input($updatable)]);
          }
      }
        return new Response(200,'Updated Successfully');
    }

    public function restrictIssue(Request $request)
    {
        $restriction = new IssueRestriction();
        $restriction->transactionid = Str::quickRandom(6);
        $restriction->for = $request->for;
        $restriction->days = $request->days;
        $restriction->books_for_issue = $request->books_for_issue;
        $restriction->fine = $request->fine;
        $restriction->save();
        return new Response(200,'OK');
    }

    public function collectFine(Request $request)
    {
        $reader = User::where('id',$request->id)->get();
        if(sizeof($reader) == 0) return new Response(404,'Reader Not Found');
        $fine = new FineCollection;
        $fine->transactionid = Str::quickRandom(6);
        $fine->readerid = $request->id;
        $fine->fine_for = $request->for;
        $fine->fine_amount = $request->amount;
        $fine->date = date('Y-m-d');
        $fine->save();
        return new Response(200,'OK');
    }
}
