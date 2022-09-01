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
    $categories = Category::latest()->paginate(4);
    $trashCategory = Category::onlyTrashed()->latest()->get();
    return view('admin.category.index',compact('categories','trashCategory'));
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
   public function edit($id)
   {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
   }
   public function update(Request $request,$id)
   {
    $this->validate($request,[
        'category_name' => 'required|unique:categories|max:255'
    ],
    [
        'category_name.required' => 'Please Input your Category Name!!',
        'category_name.max' => 'Category name less then 255 Charecter'

    ]);
    // Category::insert([
    //     'category_name' => $request->category_name,
    //     'user_id'   => Auth::user()->id,
    //     'created_at' => carbon::now()
    // ]);
    $category = Category::find($id);
    $category->category_name = $request->category_name;
    $category->user_id = Auth::user()->id;
    $category->save();


    return redirect()->route('category.index')->with('success','Updated Successfully');
   }
   public function softDelete($id)
   {
    $category = Category::find($id)->delete();
    return redirect()->back()->with('success','Remove Successfully');
   }
   public function restore($id)
   {
        $category = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Restore Successfully');
   }
   public function destroy($id)
   {
         $category = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Delete Successfully');
   }
}
