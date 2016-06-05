<?php

namespace App\Http\Controllers;

use App\Circulation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use DB;
use App\Vendor;
use DateTime;
use Session;

class VendorController extends Controller
{
    /*Return view to add vendor*/
    public function getaddVendor()
    {
      return view('vendor.addvendor')
            ->with(array('title'=>'Add Vendor','message'=>'Add Vendor'));
    }

    /*Add vendor*/
    public function addVendor(Request $request)
    {
            $vendor = new Vendor();
            $vendor->name = $request->name;
            $vendor->contact = $request->contact;
            $vendor->address = $request->address;
            $vendor->note = $request->note;
            $vendor->save();
            return Redirect::to('vendor/add')
                ->with(array('flash_message'=>'Vendor added successfully'));
    }

    /*Return view to update vendor*/
    public function getupdateVendor($id)
    {
      $vendor = Vendor::where('id',$id)
                        ->firstOrFail();

      Session::put('vendorid',$id);

      return view('vendor.update')
          ->with(array('title'=>'Update Vendor','vendor'=>$vendor));
    }

    /*Check if vendor exists in the DB*/
    public function updateVendor(Request $request)
    {
      $id = Session::get('vendorid');
      Session::forget('vendorid');
      Vendor::where('id', $id)
              ->orWhere('name',$id)
              ->update(['name' => $request->name,'contact'=>$request->contact,'note'=>$request->note]);
      return Redirect::to('/vendor/find')
                       ->with(array('flash_message'=>'Vendor Updated Successfully'));
    }

    /*Return view to find Vendor*/
    public function getvendor()
    {
      return view('vendor.findvendor')
          ->with(array('title'=>'Find Vendor','message'=>'Find Vendor'));
    }

    /*Find Vendor*/
    public function findVendor(Request $request)
    {
      $vendor = DB::table('vendor')->where('name','LIKE','%'.$request->vendortitle.'%')->get();
      return view('vendor.showvendor')->with(array('title'=>'Vendor','vendors'=>$vendor,'message'=>'Vendor Details'));
    }

    /*Return vendor names to ajax call*/
    public function returnvendor()
    {
      $vendor = DB::table('vendor')->select('name')->get();
      return $vendor;
    }
}
