<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{

	public function viewMyProducts(){
		$products = Product::where('user_id','=',auth()->user()->id)->latest()->get();
		return view('products.myproduct',compact('products'));
	}

	public function showProductAddForm(){
		$categories = Category::get();
		return view('products.addproduct',compact('categories'));
	}

	public function addProduct(Request $request){
		$this->validate($request,[
			'name' => 'required|min:2',
			'description' => 'required|min:20',
			'category_id' => 'required',
			'subcategory_id' => 'required',
			'image' => 'required|image'
		]);
		$product = new Product;
		$product->productname = $request->name;
		$product->description = $request->description;
		$product->category_id = $request->category_id;
		$product->sub_category_id = $request->subcategory_id;
		$pictureName = time().'-product.'.$request->image->getClientOriginalExtension();
		$product->picturename = $pictureName;
		$product->state = "unsold";
		$product->user_id = auth()->user()->id;
		$product->save();
		$request->image->move(public_path('images/uploads'), $pictureName);
		$request->session()->flash('message', 'Product successfully added!');
		return redirect('/products');
	}
}
