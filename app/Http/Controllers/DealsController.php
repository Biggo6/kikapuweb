<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealsController extends Controller
{
   public function index(){
	  return view('deals.index');			
   }
   
   public function store(){
	   $status     = request('status');
	   $dealImage = \App\HelperX::uplodFileThenReturnPath('dealImage');
   
	   $deal = new \App\Deal;
	   $deal->imagepath = $dealImage;
	   $deal->status = $status;
	   $deal->save();
	   
	   return response()->json(['error'=>false, 'msg'=>'']); 
	   
   }
   
   public function deleteDeal($id){
	   \App\Deal::find($id)->delete();
   }
   
}
