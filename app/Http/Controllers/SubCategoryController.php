<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\Product;

class SubCategoryController extends Controller
{
	public function addSubCategory(Request $request){
		$this->validate($request,[
			'category' => 'required|exists:categories,id',
			'name' => 'required|unique:sub_categories,name'
		]);
		$subCategory = new SubCategory;
		$subCategory->name = $request->name;
		$subCategory->category_id = $request->category;
		$subCategory->save();
		$request->session()->flash('message', 'New Sub Category '.$request->name.' added!');
		return redirect()->back();
	}

	public function getSubCategories($categoryid){
		$subCategories = SubCategory::where('category_id','=',$categoryid)->get();
		return response()->json($subCategories);
	}

	public function showAuctionsInSubCategory($categoryname, $subcategoryname){
		$category = Category::where('categoryname','=',urldecode($categoryname))->first();
		$subcategory = SubCategory::where('name','=',urldecode($subcategoryname))->first();
		$products = Product::where('category_id','=',$category->id)->where('sub_category_id','=',$subcategory->id)->get();
		return view('categories.subcategory',compact('products'));
	}

	public function delete(Request $request){
		$subCategory = SubCategory::find($request->subCatId);
		$subCategory->delete();
		$request->session()->flash('message', 'Sub Category successfully deleted!');
		return redirect()->back();
	}

	public function edit(Request $request){
		$subCategory = SubCategory::find($request->subCatId);
		$subCategory->name = $request->newSubCatName;
		$subCategory->update();
		$request->session()->flash('message', 'Sub Category successfully updated!');
		return redirect()->back();
	}
}
