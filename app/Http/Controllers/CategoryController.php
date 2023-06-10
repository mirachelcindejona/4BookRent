<?php

namespace App\Http\Controllers;

use Error;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::all();
        return view('category', ['category' => $categories]);
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);
        
        $category = Category::create($request->all());

		return redirect('category')->with('status', 'Category Added Successfully');
 
    }

    public function editCategory($slug, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

    	$category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
		return redirect('category')->with('status', 'Category Updated Successfully');
 
    }

    public function deleteCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
		return redirect('category')->with('status', 'Category Deleted Successfully');
    }
}