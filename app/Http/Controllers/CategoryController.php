<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Auction;

class CategoryController extends Controller
{
    public function showCategoryAddForm(){
        if(!auth()->user()->is_admin){
            abort(404);
        }
        $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('categories.addcategory',compact(['categories','subCategories']));
    }

    public function addCategory(Request $request){
        $category = $this->createNew($request);
        return redirect()->back();
    }

    public function createNew(Request $request){
        $this->validate($request,[
            'name'=> 'required|unique:categories,categoryname'
        ]);
        $category = new Category;
        $category->categoryname=$request->name;
        $category->save();
        $request->session()->flash('message', 'New Category '.$request->name.' added!');
        return $category;
    }

    public function showAuctionsInCategory($categoryname){
        $category = Category::where('categoryname','=',$categoryname)->first();
        $products = $category->products;
        return view('categories.category',compact('products'));
    }

    public function delete(Request $request){
        $category = Category::find($request->catId);
        $category->delete();
        $request->session()->flash('message', 'Category successfully deleted!');
        return redirect()->back();
    }

    public function edit(Request $request){
        $category = Category::find($request->catId);
        $category->categoryname = $request->newCatName;
        $category->update();
        $request->session()->flash('message', 'Category successfully updated!');
        return redirect()->back();
    }

}