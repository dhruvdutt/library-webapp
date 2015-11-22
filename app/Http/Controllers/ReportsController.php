<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ReportsController extends Controller
{
    public function generateReports(Request $request)
    {
        if($request->type == 'issue')
        {
          $reports = DB::table('circulation')
            ->whereBetween('issuedate',array($request->from,$request->to))->get();
          return view('reports.issuereport')
                  ->with(array('title'=>'Report','reports'=>$reports));
        }
        elseif($request->type == 'fine')
        {
          $reports = DB::table('circulation')
            ->whereBetween('issuedate',array($request->from,$request->to))->get();
          $fine = DB::table('circulation')->sum('fine');
          return view('reports.finereport')
                  ->with(array('title'=>'Fine Report','fine'=>$fine));
        }
        elseif($request->type == 'weedout')
        {
          $data = DB::table('accession')->where('status','=','weedout')
            ->whereBetween('updated_at',array($request->from,$request->to))->get();
          return view('reports.weedout')
                  ->with(array('title'=>'Weed Out Report','datas'=>$data));
        }
        elseif($request->type == 'missing')
        {
          $data = DB::table('accession')->where('status','=','missing')
            ->whereBetween('updated_at',array($request->from,$request->to))->get();
          return view('reports.weedout')
                  ->with(array('title'=>'Weed Out Report','datas'=>$data));
        }
    }
}
