<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class categorycrud extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin/category/index',['categories'=>$categories]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/category/create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* echo "<pre>";
        print_r($request->all());
        die; */
        $this->validate($request,[
            'category' => 'required|unique:categories'
            ]);
           
            if($request->hasFile('categoryimage')){  
                $image = $request->file('categoryimage');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("category"),$filename);
 
            }
            
            $category = new Category;
            $category->category = $request->category;
            $category->category_image = $filename;
            $category->save();
            return redirect('admin/category');
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
            $category = Category::find($id);

            return view('admin.category.edit',['category'=>$category]);
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
        $categoryimage = Category::find($id);
      
        if($request->hasFile('categoryimage')){  
            $image = $request->file('categoryimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("category"),$filename);
            $file_path = public_path().'/category/'.$categoryimage->category_image;
            unlink($file_path); 
        }
        $category = array(
            'category' => $request->category,
            'category_image' => $filename
        );
        Category::where('id',$id)->update($category); 
        return redirect('admin/category');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect('admin/category');
    }
    
    public function catstatus(Request $request)
    {
       
        $status = $request->status;
        $id = $request->user_id;
        $data  = array(
            "status" => $request->status
        );
        Category::where("id",$id)->update($data);
        // return $status;

    }

}
