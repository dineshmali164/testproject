<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\SubCategory;
use App\subsubcategory;

class subsubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $sscat = DB::table('subsubcategories')
        ->join('categories' , 'categories.id' , '=' , 'subsubcategories.category' )
        ->join('sub_categories' , 'sub_categories.id' , '=' , 'subsubcategories.subcategory')
        ->select('categories.category','sub_categories.subcategory','subsubcategories.subsubcategory','subsubcategories.subsubcategoryimage','subsubcategories.id','subsubcategories.status')->get();
        
        return view('admin.subsubcategory.index')->with(compact('sscat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.subSubCategory.create',compact('categories','subcategories'));
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
            'subsubcategory' => 'required|unique:subsubcategories'
        ]);
         
        if($request->hasFile('subsubcategoryimage')){
            $image = $request->file('subsubcategoryimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subsubcategory'),$filename);
        }

        $subsubcat = new subsubcategory;
        $subsubcat->category = $request->category;
        $subsubcat->subcategory = $request->subcategory;
        $subsubcat->subsubcategory = $request->subsubcategory;
        $subsubcat->subsubcategoryimage = $filename;
        $subsubcat->save();
        return redirect('admin/subsubcategory');
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
        $sscat = subsubcategory::find($id);
        return view('admin.subsubcategory.edit')->with(compact('sscat','categories','subcategories'));
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
        $this->validate($request,[
            'subsubcategory' => 'required|unique:subsubcategories'
        ]);
        if($request->hasFile('subsubcategoryimage')){
            $image = $request->file('subsubcategoryimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subsubcategory'),$filename);
        } else {
            $sscat = subsubcategory::find($id);
            $filename = $sscat->subsubcategoryimage;
        }
        $subsubcategory = array(
            "category" => $request->category,
            "subcategory" => $request->subcategory,
            "subsubcategory" => $request->subsubcategory,
            "subsubcategoryimage" => $filename
        );
        subsubcategory::where('id',$id)->update($subsubcategory);
        // return redirect("admin.subsubcategory");
        return redirect('admin/subsubcategory');        

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subsubcategory::where('id',$id)->delete();
        return redirect('admin/subsubcategory'); 
    }
    
    public function get_sub_ajax(Request $request)
    {
        $categories = Category::all();

         $cat = $request->cat;
        $subcategory = SubCategory::where('category',$cat)->get();
        $subcat = "<option> Sub Category </option>";
            foreach ($subcategory as $key => $value) 
            {
                $subcat .= "<option value='".$value['id']."'>".$value['subcategory']."</option>";
            }
           
           return $subcat;
    }

    public function subsubcatstatus(Request $request){
        $status = $request->status;
        $id = $request->subsubcat_id;
        $subsubcatstatus = [
            'status' => $status
        ];
        subsubcategory::where("id",$id)->update($subsubcatstatus);
    }
}
