<?php

namespace App\Http\Controllers;

use App\Circulation;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;

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
        $attempt = Auth::user()->type;
        if($attempt == 'admin')
        {
            return view('home')
            ->with(array('title'=>'Home','welcome_message'=>'Welcome'));
        }
        else
        {
            $records = Circulation::where('readerid','=',Auth::user()->id)->get();
            return view('layouts.student')
            ->with(array('title'=>'Home','welcome_message'=>'Issue Records','records'=>$records));
        }
    }
}
