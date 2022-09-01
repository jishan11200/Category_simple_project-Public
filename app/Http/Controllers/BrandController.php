<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
   {
    $brands = Brand::latest()->get();

    return view('admin.brand.index',compact('brands'));
   }
   public function store(Request $request)
   {
        $this->validate($request,[
                'brand_name' => 'required|unique:brands|max:50',
                'brand_image' => 'required|mimes:png,jpg,jpeg'
        ],
        [
           'brand_name.required' => 'Please Input Brand Name',
           'brand_name.max' => 'Brand name less then 50 character',
            'brand_image.required' => 'Please Input Brand image'
        ]);
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' => Carbon::now()

        ]);

        // $brand = new Brand;
        // $brand->brand_name = $request->brand_name;

        // $brand->brand_image = $last_img;
        // $brand->save();
        return redirect()->route('brand.index')->with('success','Inserted Successfully');
   }
}
