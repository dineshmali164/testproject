<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\SubCategory;
use App\subsubcategory;
use App\brand;


class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $brands = DB::table('brands')
        ->join('categories' , 'categories.id' , '=' , 'brands.category' )
        ->join('sub_categories' , 'sub_categories.id' , '=' , 'brands.subcategory')
        ->join('subsubcategories' , 'subsubcategories.id' , '=' , 'brands.subsubcategory')
        ->select('categories.category','sub_categories.subcategory','subsubcategories.subsubcategory','brands.brand','brands.id','brands.brandimage','brands.status')->get();
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create',compact('categories'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'brand' => 'required|unique:brands'
            ]);
            if($request->hasFile('brandimage'))
            {
                $image = $request->file('brandimage');
                $filename  = time() . '.' .$image->getClientOriginalExtension();
                $image->move(public_path('brand'),$filename);
            } 
            $brand = new brand;
            $brand->category = $request->category;
            $brand->subcategory = $request->subcategory;
            $brand->subsubcategory = $request->subsubcategory;
            $brand->brand = $request->brand;
            $brand->brandimage = $filename;
            $brand->save();
            return redirect('admin/brand');
        }
        
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
           
            
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $subsubcategories = subsubcategory::all();
            $brand = brand::find($id); 
            return view('admin.brand.edit',compact('brand','categories','subcategories','subsubcategories'));
        }
        
        /**
         * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        if($request->hasFile('brandimage')){
            $image = $request->file('brandimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('brand'),$filename);
        } else {
            $brand = brand::find($id);
            $filename = $brand->brandimage;
        }

        $brand = array(
            "category" => $request->category,
            "subcategory" => $request->subcategory,
            "subsubcategory" => $request->subsubcategory,
            "brand" => $request->brand,
            "brandimage" => $filename
        );
        brand::where('id',$id)->update($brand);
        return redirect('admin/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        brand::where('id',$id)->delete();
        return redirect('admin/brand');
    }
    public function brand_subcategory_data(Request $request)
    {
        
        $cat = $request->cat;
        $subcategory = SubCategory::where('category',$cat)->get();
        $subcat = "<option> Sub Category </option>";
        foreach($subcategory as $key => $value) {
           $subcat .="<option value='".$value['id']."'>".$value['subcategory']."</option>";
        }
        return $subcat;
    }
    public function brand_subsubcategory_data(Request $request)
    {
        $subcat = $request->subcat;
        $subsubcategory = subsubcategory::where('subcategory',$subcat)->get();
        $subsubcat = "<option> Sub Sub Category </option>";
        foreach ($subsubcategory as $key => $value) {
            $subsubcat .="<option value='".$value['id']."'>".$value['subsubcategory']." </option>";
        }
        return $subsubcat;
    } 

    public function brandstatus(Request $request)
    {    
        $status = $request->status;
        $id = $request->brand_id;
        $brand = [
            "status" => $status
        ];
        brand::where("id",$id)->update($brand); 

    }
}
