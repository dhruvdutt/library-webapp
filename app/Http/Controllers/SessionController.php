<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Input;
use Auth;
use Redirect;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Session;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        /*Authenticate the user*/
        $input = Input::all();
        $attempt = Auth :: attempt([
            'id'=>$input['userid'],
            'password'=>$input['password']
        ]);
        if($attempt)
        {
            $user = Auth::user();
            if($user->login_first_time == 'yes')
            {
              /*Put id in session to access it while changing password for the first time*/
              Session::put('id',$user->id);
              return view('profile.first_password_change')
                      ->with(array('title'=>'Change Password','welcome_message'=>'Change your password'));
            }
            else
            {
                return Redirect::intended('/home');
            }
        }
        Session::flash('flash_message','Invalid Credentials');
        return redirect::back();
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('flash_message', 'Logged out');
    }

    /*Return view to find Reader*/
    public function getreader()
    {
      return view('Reader.findreader')
          ->with(array('title'=>'Find Reader','message'=>'Find Reader'));
    }

    /*Find Reader*/
    public function findReader(Request $request)
    {
      $reader = DB::table('users')->select('id','name','department','year')->where('name','LIKE','%'.$request->readerTitle.'%')->get();
      return view('Reader.showreader')->with(array('title'=>'Reader','readers'=>$reader));
    }

    /*Return view to add reader*/
    public function getaddReader()
    {
      return view('Reader.addReader')
          ->with(array('title'=>'Add Reader','message'=>'Add Reader'));
    }

    /*Add Reader*/
    public function addReader(Request $request)
    {
      $user = new User();
      $user->name = $request->name;
      $user->type = $request->type;
      $user->department = $request->department;
      $user->year = $request->year;
      $user->password = Hash::make('1234');
      $user->login_first_time = 'yes';
      $user->save();
      return Redirect::to('reader/add')
                  ->with(array('flash_message'=>'Reader added successfully'));
    }

    /*Return View to update reader*/
    public function getupdateReader()
    {
      return view('Reader.updateReaderInput')
          ->with(array('title'=>'Update Reader','message'=>'Update Reader'));
    }

    /*Check if reader exists and if yes send the view with records*/
    public function updateReader(Request $request)
    {
      $id = $request->readerID;
      $reader = DB::table('users')
            ->where('id','=',$id)->get();
      if(sizeof($reader) == 0)
      {
         return Redirect::back()->withInput()
            ->with(array('flash_message'=>'No Record with this ID or title'));
      }
      else
      {
      Session::put('readerid',$reader[0]->id);
          return view('Reader.updateReader')
              ->with(array('title'=>'Update Reader','reader'=>$reader[0]));
      }
    }

    public function update(Request $request)
    {
        DB::table('users')
            ->where('id', Session::get('readerid'))
            ->update(['name' => $request->name,'type'=>$request->type,'department'=>$request->department,'year'=>$request->year]);
        Session::forget('readerid');
        return Redirect::to('reader/update')
            ->with(array('flash_message'=>'Updated Successfully'));
    }

    /*Change Password when first time login*/
    public function change(Request $request)
    {
      $newpassword = Hash::make($request->newpassword);
      DB::table('users')
          ->where('id', Session::get('id'))
          ->update(['password' => $newpassword,'login_first_time'=>'no']);
      Session::forget('id');
      return Redirect::to('/home')->with('flash_  message','Password Changed Successfully');
    }

    /*Return view to migrate readers*/
     public function getmigrateReaders(){
      return view('Reader.getMigrateReader')
          ->with(array('title'=>'Readers Migration','message'=>'Migrate Readers'));
    }

    /*Migrate readers*/
    public function migratereaders(Request $request)
    {
      $from = $request->from;
      $to = $request->to;

      DB::table('users')
        ->where('year', $from)
        ->update(['year' => $to]);

      $from = strtoupper($from);
      $to = strtoupper($to);
      return Redirect::to('reader/migrate')
          ->with(array('flash_message'=>'Readers Migrated Successfully'));
    }

    /*Return View to reset password*/
    public function getResetPassword(){
      return view('Reader.resetPassword')
          ->with(array('title'=>'Reset Password','message'=>'Reset Password'));
    }

    /*Reset password*/
    public function resetPassword(Request $request)
    {
      $id = $request->id;
      $reader = DB::table('users')
                ->where('id','=',$id)->get();
      if(sizeof($reader) == 0)
      {
          return Redirect::back()->withInput()
              ->with(array('flash_message'=>'No Record with this ID'));
      }
      elseif ($reader[0]->type=="admin")
      {
          return Redirect::back()->withInput()
              ->with(array('flash_message'=>'Cannot Reset Password for Admin'));
      }
      else
      {
        $new_pwd = Hash::make('1234');
        DB::table('users')
          ->where('id', $id)
          ->update(['password' => $new_pwd,'login_first_time'=>'yes']);

        return Redirect::to('/reader/resetpassword')
            ->with(array('flash_message'=>'Password Reset Successfull'));
      }
    }
}
