<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Category;

class subcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $subcategories = subCategory::all();
        $subcategories = DB::table('sub_categories')
                        ->join('categories','categories.id' , '=' , 'sub_categories.category')
                        ->select('categories.category','sub_categories.subcategory','sub_categories.subcategoryimage','sub_categories.id','sub_categories.status')->get();
    
        return view('admin.subcategory.index')->with(compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.subcategory.create')->with(compact('categories'));
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
            'subcategory' => 'required|unique:sub_categories'
            ]);
           
            if($request->hasFile('subcategoryimage')){  
                $image = $request->file('subcategoryimage');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("subcategory"),$filename);
            }
            $subcategory = new subCategory;
            $subcategory->category = $request->category;
            $subcategory->subcategory = $request->subcategory;
            $subcategory->subcategoryimage = $filename;
            $subcategory->save();
            return redirect('admin/subcategory');
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
        $subcategory = subCategory::find($id);
        $categories = Category::get();
        return view('admin.subcategory.edit',['subcategory'=>$subcategory,'categories'=>$categories]);
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
        $subcategory = subCategory::find($id);
        
        if($request->hasFile('subcategoryimage')){
            $image = $request->file('subcategoryimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("subcategory"),$filename);
            // unlink(public_path("subcategory"),$subcategory->subcategoryimage);
        } else {
            $filename = $subcategory->subcategoryimage;
        }

        $subcategory =array(
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'subcategoryimage'=>$filename
        );

        subCategory::where('id',$id)->update($subcategory);
        // return redirect('admin.subcategory');
        return redirect('admin/subcategory');        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::where('id',$id)->delete();
        return redirect('admin/subcategory');
    }
    
    public function subcatstatus(Request $request)
    {
        $status = $request->status;
            
         $id = $request->subcat_id;
        $subcatstatus = [
            'status' => $status
        ];
        subCategory::where("id",$id)->update($subcatstatus);
    }
}
