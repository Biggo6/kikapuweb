<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\ItemType;

class ConfigureController extends Controller
{
    public function systemUpdate(){
    	return view('system.update');
    }
	
	
	public function manageRoles(){
		return view('system.manageRoles');
	}
	
	public function managePerms(){
		return view('system.managePerms');
	}


	public function addCategory(){
		return view('system.categories');
	}

	public function addTypes(){
		return view('system.types');
	}
	

	public function storeCategory(){
	   $catName = request('catName');
	   $status  = request('status');


	   $check = Category::where('category_name', $catName)->count();

	   if($check){
	   		return response()->json(['error'=>true, 'msg'=>'Category already registred']);
	   }else{
	   		$cat = new Category;
	   		$cat->category_name = $catName;
	   		$cat->status        = $status;
	   		$cat->save();
	   		return response()->json(['error'=>false, 'msg'=>'']);
	   }

	}

	public function editTypes($id){
		$type  = ItemType::find($id);
		return view('types.edit', compact('type'));
	}

	public function storeTypes(){
	   $typeName = request('typeName');
	   $status  = request('status');


	   $check = ItemType::where('type_name', $typeName)->count();

	   if($check){
	   		return response()->json(['error'=>true, 'msg'=>'Type already registred']);
	   }else{
	   		$type = new ItemType;
	   		$type->type_name     = $typeName;
	   		$type->status        = $status;
	   		$type->save();
	   		return response()->json(['error'=>false, 'msg'=>'']);
	   }
	}

	public function editCategory($id){
		$category =  Category::find($id);
		return view('categories.edit', compact('category'));
	}

	public function deleteCategory($id){
		Category::find($id)->delete();
	}


	public function updateCategory($id){
		$catName = request('catName');
	   $status  = request('status');


	   $check = Category::where('category_name', $catName)->where('id', '!=',$id)->count();

	   if($check){
	   		return response()->json(['error'=>true, 'msg'=>'Category already registred']);
	   }else{
	   		$cat = Category::find($id);
	   		$cat->category_name = $catName;
	   		$cat->status        = $status;
	   		$cat->save();
	   		return response()->json(['error'=>false, 'msg'=>'']);
	   }
	}

	public function deleteType($id){
		ItemType::find($id)->delete();
	}


	public function updateTypes($id){
	   $typeName = request('typeName');
	   $status  = request('status');


	   $check = ItemType::where('type_name', $typeName)->where('id', '!=',$id)->count();

	   if($check){
	   		return response()->json(['error'=>true, 'msg'=>'Type already registred']);
	   }else{
	   		$type = ItemType::find($id);
	   		$type->type_name     = $typeName;
	   		$type->status        = $status;
	   		$type->save();
	   		return response()->json(['error'=>false, 'msg'=>'']);
	   }
	}

}
