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
use App\Http\Requests\AuthRequest;
use App\IssueRestriction;
use App\Circulation;

class SessionController extends Controller
{
    public function store(AuthRequest $request)
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
                    ->with(array('title'=>'Change Password','message'=>'Change your password'));
          }
          else
          {
              return Redirect::to('/reader/find');
          }
        }
        Session::flash('flash_message','Invalid Credentials');
        return redirect::back()->withInput(Input::except('password'));
    }

    public function destroy()
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('flash_message', 'Logged out');
    }

    /*Return view to find Reader*/
    public function getFindReader()
    {
      return view('Reader.findreader')->with(array('title'=>'Find Reader','message'=>'Find Reader'));
    }

    /*Find Reader*/
    public function findReader(Request $request)
    {
      $this->validate($request,[
        'readerTitle' => 'required'
      ]);
      $reader = User::select('id','name','department','year')
                ->where('id',$request->readerTitle)
                ->orWhere('name','LIKE','%'.$request->readerTitle.'%')
                ->get();

      return view('Reader.showreader')->with(array('title'=>'Reader','readers'=>$reader,'message'=>'Reader Details'));
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
      $users = DB::table('users')
                ->orderBy('id', 'desc')
                ->first();

      $oldindex = str_split($users->id,6)[1];
      $oldyear = substr($users->id,2,4);

      if((int)$oldyear == $request->year_enrolled)
      {
          $oldindex = $oldindex+1;

          if($oldindex<10)
          {
            $oldindex='00'.$oldindex;
          }
          elseif($oldindex>=10 && $oldindex<100)
          {
            $oldindex='0'.$oldindex;
          }
      }
      else if ($request->year_enrolled < (int)$oldyear)
      {
          $x = DB::table('users')
              ->where('year_enrolled',$request->year_enrolled)
              ->orderBy('id', 'desc')
              ->get();

          if(sizeof($x) == 0)
          {
            $oldindex = 1;
          }
          else
          {
            $oldindex = str_split($x[0]->id,6)[1];
            $oldindex = $oldindex+1;
          }

          if($oldindex<10)
          {
            $oldindex=(int)$oldindex;
            $oldindex='00'.$oldindex;
          }
          elseif($oldindex>=10 && $oldindex<100)
          {
            $oldindex='0'.$oldindex;
          }
      }
      else
      {
        $oldindex = 1;

        if($oldindex<10)
        {
          $oldindex='00'.$oldindex;
        }
        elseif($oldindex>=10 && $oldindex<100)
        {
          $oldindex='0'.$oldindex;
        }
      }


      $year = $request->year_enrolled;
      $id='CA'.$year.($oldindex);

      $user = new User();
      $user->id = $id;
      $user->name = $request->name;
      $user->type = $request->type;
      $user->department = $request->department;
      $user->year = $request->year;
      $user->password = Hash::make('1234');
      $user->login_first_time = 'yes';
      $user->year_enrolled = $request->year_enrolled;
      $user->save();
      return Redirect::to('reader/add')
                  ->with(array('flash_message'=>$id));
    }

    /*Return View to update reader*/
    public function getUpdateReader($id)
    {
      $reader = User::where('id',$id)
                ->firstOrFail();
     return view('Reader.updateReader')
            ->with(array('title'=>'Update Reader','reader'=>$reader,'message'=>'Update Reader'));
    }

    public function updateReader(Request $request)
    {
        User::where('id', $request->id)
            ->update(['name' => $request->name,'type'=>$request->type,'department'=>$request->department]);
        return Redirect::to('reader/find')
            ->with(array('flash_message'=>'Updated Successfully'));
    }

    /*Change Password when first time login*/
    public function changePassword(Request $request)
    {
      $newpassword = Hash::make($request->newpassword);
      User::where('id', Session::get('id'))
          ->update(['password' => $newpassword,'login_first_time'=>'no']);
      Session::forget('id');
      return Redirect::to('/home')->with('flash_message','Password Changed Successfully');
    }

    /*Return view to migrate readers*/
     public function getmigrateReaders($year){

      $readers = User::select('id','name','department','year')->where('year','=',$year)->paginate(5);

      Session::put('year',$year);
      return view('Reader.getMigrateReader')
          ->with(array('title'=>'Readers Migration','message'=>'Migrate Readers','readers'=>$readers));
    }

    /*Migrate readers*/
    public function migratereaders(Request $request)
    {
      $year = Session::get('year');
      Session::forget('year');
      switch ($year) {
        case 'fybca':
          $to = 'sybca';
          break;
        case 'sybca':
          $to = 'tybca';
          break;
        case 'tybca':
          $ids = Input::get('ids');

          foreach($ids as $id)
          {
            $user = User::find($id);
            $user->delete();
          }
          return Redirect::to('home')
              ->with(array('flash_message'=>'Readers Migrated Successfully'));
        case 'fymsc':
          $to = 'symsc';
          break;
        case 'symsc':
          $ids = Input::get('ids');
          foreach($ids as $id)
          {
            $user = User::find($id);
            $user->delete();
          }
          return Redirect::to('home')
              ->with(array('flash_message'=>'Readers Migrated Successfully'));
        default:
          $to = $year;
          break;
      }
      $ids = Input::get('ids');
      foreach($ids as $id)
      {
        DB::table('users')
          ->where('id', $id)
          ->update(['year' => $to]);
      }

      return Redirect::to('home')
          ->with(array('flash_message'=>'Readers Migrated Successfully'));
    }

    /*Reset password*/
    public function resetPassword($id)
    {
      $reader = User::where('id','=',$id)
                    ->firstOrFail();

      if ($reader->type=="admin")
      {
          return Redirect::back()->withInput()
              ->with(array('flash_message'=>'Cannot Reset Password for Admin'));
      }
      else
      {
        $new_pwd = Hash::make('1234');
        User::where('id', $id)
          ->update(['password' => $new_pwd,'login_first_time'=>'yes']);

        return Redirect::to('/reader/find')
            ->with(array('flash_message'=>'Password Reset Successfull'));
      }
    }

    public function profile()
    {
      $restriction = IssueRestriction::where('for',Auth::user()->year)->firstOrFail();
      return view('profile.me')
             ->with(['title'=>'Profile','reader'=>Auth::user(),'restriction'=>$restriction,'message'=>'Your Profile']);
    }
}
