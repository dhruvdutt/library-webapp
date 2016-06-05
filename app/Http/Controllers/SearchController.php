<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\User;

class SearchController extends Controller
{
    /*Seach Publication by author isbn title and publisher*/
    public function search($book,$query)
    {
        $result = [];
        $values = DB::table('publication')
            ->where($query,'LIKE','%'.$book.'%')
            ->select($query)
            ->get();

        $final = [];
        foreach ($values as $current)
        {
          if ( ! in_array($current, $final))
          {
            $final[] = $current;
          }
        }
        foreach ($final as $f)
        {
          $result[] = ['value'=>$f->$query];
        }

      return json_encode($result);
    }

    /*Search Publication Title*/
    public function searchPublication()
    {
        $result = array();
        $term = Input::get('term');
        $values = DB::table('publication')
            ->where('isbn','LIKE','%'.$term.'%')
            ->orWhere('title','LIKE','%'.$term.'%')
            ->select('title')
            ->get();

            foreach ($values as $value)
            {
                $result[] = [ 'value' => $value->title ];
            }
        return json_encode($result);
    }

    /*Search Serial Title*/
    public function searchSerial()
    {
        $result = array();
        $term = Input::get('term');
        $values = DB::table('serials')
            ->where('issn','LIKE','%'.$term.'%')
            ->orWhere('title','LIKE','%'.$term.'%')
            ->orWhere('serial_no','LIKE','%'.$term.'%')
            ->select('title')
            ->get();

            foreach ($values as $value)
            {
                $result[] = [ 'value' => $value->title ];
            }
        return json_encode($result);
    }

    /*Seach Vendor title used for suggestions while adding of Publication*/
    public function vendor()
    {
        $result = array();
        $term = Input::get('term');
        $values = DB::table('vendor')
            ->where('name','LIKE','%'.$term.'%')
            ->get();

        foreach ($values as $value)
        {
            $result[] = [ 'value' => $value->name ];
        }
        return json_encode($result);
    }

    /*Search Reader*/
    public function reader()
    {
        $result = array();
        $term = Input::get('term');

        $values = User::where('name','LIKE','%'.$term.'%')
                        ->orWhere('id','LIKE','%'.$term.'%')
                        ->get();
          foreach ($values as $value)
          {
              $result[] = ['value' => $value->id,'label'=>$value->name.' ('.$value->id.')'];
          }
        return $result;
    }

    /*Check availibility of Book and return view with the data*/
    public function searchBook($value,$query)
    {
      $publications = DB::table('publication')
                          ->join('accession', function ($join) {
                              $join->on('accession.isbn', '=', 'publication.isbn')
                                   ->where('status','=','available');
                              })
                          ->where($query,'LIKE','%'.$value.'%')
                          ->select('publication.isbn','publication.title','publication.author','publication.publisher','accession.status')
                          ->get();

        $final = [];
        foreach ($publications as $current)
        {
          if ( ! in_array($current, $final))
          {
            $final[] = $current;
          }
        }
        if(!empty($final))
        {
          $publications = $final;
        }
        if(empty($publications))
        {
          $publications = DB::table('publication')
                            ->where($query,'LIKE','%'.$value.'%')
                            ->select('publication.isbn','publication.title','publication.author','publication.publisher')
                            ->get();
           foreach($publications as $publication)
           {
             $publication->status = 'notavailable';
           }
        }
        return view('searchBook')
               ->with(array('title'=>'Publication Details','publications'=>$publications,'message'=>'Publication Details'));
    }
}
