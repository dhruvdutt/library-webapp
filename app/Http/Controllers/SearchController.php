<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /*Seach Publication by author isbn title and publisher*/
    public function search($book,$query)
    {
        $result = array();
        $values = DB::table('publication')
            ->where($query,'LIKE','%'.$book.'%')
            ->get();
        if(sizeof($values) == 0)
        {
            $result[] = ['value'=>'No Suggestions'];
        }
        else
        {
            foreach ($values as $value) {
                $result[] = [ 'value' => $value->$query ];
            }
        }
        return json_encode($result);
    }

    /*Search Publication Title*/
    public function searchTitle()
    {
        $result = array();
        $term = Input::get('term');
        $values = DB::table('publication')
            ->where('isbn','LIKE','%'.$term.'%')
            ->orWhere('title','LIKE','%'.$term.'%')
            ->get();
        if(sizeof($values) == 0)
        {
            $result[] = ['value'=>'No Suggestions'];
        }
        else
        {
            foreach ($values as $value) {
                $result[] = [ 'value' => $value->title ];
            }
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
        if(sizeof($values) == 0)
        {
            $result[] = ['value'=>'No Suggestions'];
        }
        else
        {
            foreach ($values as $value) {
                $result[] = [ 'value' => $value->name ];
            }
        }
        return json_encode($result);
    }

    /*Search Reader*/
    public function reader(Request $request)
    {
        $result = array();
        $term = Input::get('term');
        $values = DB::table('users')
            ->where('name','LIKE','%'.$term.'%')
            ->orWhere('id','LIKE','%'.$term.'%')
            ->get();
        if(sizeof($values) == 0)
        {
            $result[] = ['value'=>'No Suggestions'];
        }
        else
        {
            foreach ($values as $value) {
                $result[] = ['value' => $value->name];
            }
        }
        return json_encode($result);
    }

    /*Check availibility of Book and return view with the data*/
    public function searchBook($value)
    {
      $status = 'Not Available';
      $publications = DB::table('publication')
          ->where('title','LIKE','%'.$value.'%')
          ->orWhere('publisher','LIKE','%'.$value.'%')
          ->orWhere('author','LIKE','%'.$value.'%')
          ->get();
          
    if(sizeof($publications) == 0)
    {
        return view('searchBook')
               ->with(array('title'=>'Book','publications'=>null,'status'=>null));
    }
      $availablity = DB::table('accession')
            ->where('isbn','=',$publications[0]->isbn)->get();
            
       for($i=0;$i<sizeof($availablity);$i++)
       {
            if($availablity[$i]->status == 'available')
            {
                $status = 'Available';
                break;
            }
       }
          return view('searchBook')
                  ->with(array('title'=>'Book','publications'=>$publications,'status'=>$status));
    }
}
