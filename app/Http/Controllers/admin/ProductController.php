<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\SubCategory;
use App\subsubcategory;
use App\brand;
use App\Type;
use App\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
        ->join('categories' , 'categories.id' , '=' , 'products.category' )
        ->join('sub_categories' , 'sub_categories.id' , '=' , 'products.subcategory')
        ->join('subsubcategories' , 'subsubcategories.id' , '=' , 'products.subsubcategory')
        ->join('types' , 'types.id' , '=' , 'products.type')
        ->join('brands' , 'brands.id' , '=' , 'products.brand')
        ->select('categories.category','sub_categories.subcategory','subsubcategories.subsubcategory', 'types.type','brands.brand','products.product_name','products.product_price','products.product_offer_price','products.product_qty','products.product_description','products.product_image','products.product_gst','products.product_weight','products.id')->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = brand::all();
        $types = Type::all();
        return view('admin/product/create',compact('categories','brands','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('product_image')){  
            $image = $request->file('product_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("product"),$filename);
        } 
        $product = new Product;
        $product->category = $request->category;
        $product->subcategory = $request->subcategory;
        $product->subsubcategory = $request->subsubcategory;
        $product->type = $request->type;
        $product->brand = $request->brand;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_offer_price = $request->product_offer_price;
        $product->product_qty = $request->product_qty;
        $product->product_description = $request->product_description;
        $product->product_image = $filename;
        $product->product_gst = $request->product_gst;
        $product->product_weight = $request->product_weight;
        $product->save();
        return redirect('admin/product');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $types = Type::all();
        $brands = brand::all();
        $product = Product::find($id);

        return view('admin.product.edit',compact('categories','subcategories','subsubcategories','types','brands','product'));
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
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product'),$filename);
        } else {
            $product = Product::find($id);
            $filename = $product->product_image;
        }
        $product = array(
            "category" => $request->category,
            "subcategory" => $request->subcategory,
            "subsubcategory" => $request->subsubcategory,
            "type" => $request->type,
            "brand" => $request->brand,
            "product_name" => $request->product_name,
            "product_price" => $request->product_price,
            "product_offer_price" => $request->product_offer_price,
            "product_qty" => $request->product_qty,
            "product_description" => $request->product_description,
            "product_image" => $filename,
            "product_gst" => $request->product_gst,
            "product_weight" => $request->product_weight
        );
        Product::where('id',$id)->update($product);
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return redirect('admin/product');
    }
    public function product_subcategory_data(Request $request)
    {
        $cat = $request->cat;
        $subcategory = SubCategory::where('category',$cat)->get();
        $subcat = "<option> Sub Category </option>";
        foreach($subcategory as $key => $value) 
        {
           $subcat .="<option value='".$value['id']."'>".$value['subcategory']."</option>";
        }
        return $subcat;
    }
    public function product_subsubcategory_data(Request $request)
    {
        $subcat = $request->subcat;
        $subsubcategory = subsubcategory::where('subcategory',$subcat)->get();
        $subsubcat = "<option> Sub Sub Category </option>";
        foreach ($subsubcategory as $key => $value) 
        {
            $subsubcat .="<option value='".$value['id']."'>".$value['subsubcategory']." </option>";
        }
        return $subsubcat;
    }
}
