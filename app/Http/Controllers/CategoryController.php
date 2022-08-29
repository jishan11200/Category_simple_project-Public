<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
   public function index()
   {
    $categories = Category::all();
    return view('admin.category.index',compact('categories'));
   }

   public function store(Request $request)
   {
        $this->validate($request,[
            'category_name' => 'required|unique:categories|max:255'
        ],
        [
            'category_name.required' => 'Please Input your Category Name!!',
            'category_name.max' => 'Category name less then 255 Charecter'

        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'user_id'   => Auth::user()->id,
            'created_at' => carbon::now()
        ]);
        return redirect()->back()->with('success','Inserted Successfully');
   }
}
