<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Vendor;
use App\User;

class ReportsController extends Controller
{
    public function generateReports(Request $request)
    {
        if($request->type == 'issue')
        {
          $report = DB::table('circulation')
                        ->join('accession', 'accession.accession_no', '=', 'circulation.accession_no')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->join('users', 'users.id', '=', 'circulation.readerid')
                        ->select('circulation.*', 'users.id','users.year', 'users.name','users.year_enrolled','accession.isbn','publication.*')
                        ->whereBetween('issuedate',array($request->from,$request->to))
                        ->whereNull('users.deleted_at')
                        ->get();

          return view('reports.issuereport')
                  ->with(array('title'=>'Report','reports'=>$report,'message'=>'Issue Report'));
        }
        elseif($request->type == 'fine' or $request->type == 'fine_reader' )
        {
          if($request->type == 'fine_reader')
          {
            $id = User::where('id',$request->readerTitle)->select('id')->get();

            $report = DB::table('fine_collection')
                          ->join('users', 'users.id', '=', 'fine_collection.readerid')
                          ->where('fine_collection.readerid','=',$id[0]->id)
                          ->whereBetween('fine_collection.date',array($request->from,$request->to))
                          ->get();

            $fine = DB::table('fine_collection')
                        ->where('readerid',$id[0]->id)
                        ->whereBetween('date',array($request->from,$request->to))
                        ->sum('fine_amount');
          }
          else
          {
            $report = DB::table('fine_collection')
                          ->join('users', 'users.id', '=', 'fine_collection.readerid')
                          ->whereBetween('fine_collection.date',array($request->from,$request->to))
                          ->get();

          $fine = DB::table('fine_collection')
                      ->whereBetween('date',array($request->from,$request->to))
                      ->sum('fine_amount');
          }

          return view('reports.finereport')
                  ->with(array('title'=>'Fine Report','reports'=>$report,'fine'=>$fine,'message'=>'Fine Report'));
        }
        elseif($request->type == 'unreturned_publications')
        {
          $report = DB::table('circulation')
                        ->join('accession', 'accession.accession_no', '=', 'circulation.accession_no')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->join('users', 'users.id', '=', 'circulation.readerid')
                        ->select('circulation.*', 'users.id','users.year', 'users.name','users.year_enrolled','accession.isbn','publication.*')
                        ->whereNull('returneddate')
                        ->whereBetween('issuedate',array($request->from,$request->to))
                        ->whereNull('users.deleted_at')
                        ->get();

          return view('reports.issuereport')
                  ->with(array('title'=>'Weed Out Report','reports'=>$report,'message'=>'Weedout Publications'));
        }
        elseif($request->type == 'weedout')
        {
          $report = DB::table('accession')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->where('status','=','weedout')
                        ->whereBetween('accession.updated_at',array($request->from,$request->to))
                        ->get();

          return view('reports.weedout')
                  ->with(array('title'=>'Weed Out Report','datas'=>$report,'message'=>'Weedout Publications'));
        }
        elseif($request->type == 'missing')
        {
          $report = DB::table('accession')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->where('status','=','missing')
                        ->whereBetween('accession.updated_at',array($request->from,$request->to))
                        ->select('publication.isbn','publication.title','publication.author','accession.*')
                        ->get();

          return view('reports.weedout')
                  ->with(array('title'=>'Weed Out Report','datas'=>$report,'message'=>'Missing Publications'));
        }
        elseif($request->type == 'publication_acquisition')
        {
          $id = Vendor::where('name',$request->vendortitle)->select('id')->get();
          $report = DB::table('acquisition')
                        ->join('publication', 'acquisition.isbn', '=', 'publication.isbn')
                        ->join('vendor', 'vendor.id', '=', 'acquisition.vendorid')
                        ->where('vendorid','=',$id[0]->id)
                        ->whereBetween('acquisition.purchased_date',array($request->from,$request->to))
                        ->select('publication.isbn','publication.title','publication.author','acquisition.*','vendor.*')
                        ->get();

          return view('reports.publication_acquisition')
                  ->with(array('title'=>'Publication Acquisition Report','reports'=>$report,'message'=>'Publication Acquisition Details'));
        }
        elseif($request->type == 'serial_acquisition')
        {
          $id = Vendor::where('name',$request->vendortitle)->select('id')->get();
          $report = DB::table('acquisition_serials')
                        ->join('serials', 'acquisition_serials.serial_no', '=', 'serials.serial_no')
                        ->join('vendor', 'vendor.id', '=', 'acquisition_serials.vendorid')
                        ->where('vendorid','=',$id[0]->id)
                        ->whereBetween('acquisition_serials.purchased_date',array($request->from,$request->to))
                        ->select('serials.*','acquisition_serials.*','vendor.*')
                        ->get();

          return view('reports.serials_acquisition')
                  ->with(array('title'=>'Serial Acquisition Report','reports'=>$report,'message'=>'Serial Acquisition Details'));
        }
        elseif($request->type == 'circulation_reader')
        {
         $id = User::where('id', '=', $request->readerTitle)
                    ->get();

          $id = User::withTrashed()
                    ->where('id',$request->readerTitle)
                    ->select('id')
                    ->get();

          $report = DB::table('circulation')
                        ->join('accession', 'accession.accession_no', '=', 'circulation.accession_no')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->join('users', 'users.id', '=', 'circulation.readerid')
                        ->where('circulation.readerid','=',$id[0]->id)
                        ->whereBetween('issuedate',array($request->from,$request->to))
                        ->whereNull('users.deleted_at')
                        ->select('circulation.*','users.id','users.name','users.year','publication.isbn','publication.title','publication.author')
                        ->get();

          return view('reports.circulation_reader')
                  ->with(array('title'=>'Circulation Report for '.$id[0]->id,'reports'=>$report,'message'=>'Circulation Report for '.$id[0]->id));
        }
        elseif($request->type == 'old_circulation_reader')
        {
          $id = User::withTrashed()
                    ->where('id',$request->readerTitle)
                    ->select('id')
                    ->get();

          $report = DB::table('circulation')
                        ->join('accession', 'accession.accession_no', '=', 'circulation.accession_no')
                        ->join('publication', 'accession.isbn', '=', 'publication.isbn')
                        ->join('users', 'users.id', '=', 'circulation.readerid')
                        ->where('circulation.readerid','=',$id[0]->id)
                        ->whereNotNull('users.deleted_at')
                        ->select('circulation.*','users.id','users.name','users.year','publication.isbn','publication.title','publication.author')
                        ->get();

          return view('reports.circulation_reader')
                  ->with(array('title'=>'Circulation Report for '.$id[0]->id,'reports'=>$report,'message'=>'Circulation Report for '.$id[0]->id));
        }
    }
}
