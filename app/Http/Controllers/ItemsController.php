<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller {

	public function index(){
		return view('items.index');
	}	
	
	public function deleteItem($id){
		\App\Product::find($id)->delete();
	}

	public function getItems($item){
		$items = \App\Product::where('category', $item)->get();
		$dataX = [];
		foreach($items as $item){
			$data  = [];
			$data["id"]       = $item->id;
			$data["title"]    = $item->title;
			$data["price"]    = "Tshs " . number_format($item->price) . "/=";
			$data["cost"]     = ($item->price);
			$data["category"] = $item->category;
			$data["status"]   = $item->status;
			$data["productimage"]       = $item->productimage;
			$data["types"]       = explode(",", $item->types);
			
			$dataX[]          = $data;
		}
		return response()->json($dataX);
	}

	public function getAllItems(){
		$items = \App\Product::all();
		$dataX = [];
		foreach($items as $item){
			$data  = [];
			$data["id"]       = $item->id;
			$data["title"]    = $item->title;
			$data["price"]    = "Tshs " . number_format($item->price) . "/=";
			$data["category"] = $item->category;
			$data["status"]   = $item->status;
			$data["productimage"]       = $item->productimage;
			$data["types"]       = explode(",", $item->types);
			
			$dataX[]          = $data;
		}
		return response()->json($dataX);
	}


	public function store(){
		$itemTitle = request('itemTitle');
		$itemPrice = request('itemPrice');
		$category  = request('category');
		$status    = request('status');
		$itemImage = \App\HelperX::uplodFileThenReturnPath('itemImage');

		$typesArr = '';

		if(request()->has('types')){
			$types = request('types');
			foreach ($types as $t) {
				$typesArr .= $t . ",";
			}
		}

		$product  = new \App\Product;
		$product->title        = $itemTitle;
		$product->price        = $itemPrice;
		$product->category     = $category;
		$product->status       = $status;
		$product->productimage = $itemImage;
		$product->types        = $typesArr;
		$product->save();

		return response()->json(['error'=>false, 'msg'=>'']); 
		
	}

}