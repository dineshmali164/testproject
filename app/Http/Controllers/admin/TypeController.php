<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\SubCategory;
use App\subsubcategory;
use App\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
    //   echo "<pre>";
    //   print_r($types->toarray());
    //   die;
    /*     $types = DB::table('types')
        ->join('categories' , 'categories.id' , '=' , 'types.category' )
        ->join('sub_categories' , 'sub_categories.id' , '=' , 'types.subcategory')
        ->join('subsubcategories' , 'subsubcategories.id' , '=' , 'types.subsubcategory')
        ->select('categories.category','sub_categories.subcategory','subsubcategories.subsubcategory','types.type','types.id','types.typeimage')->get(); */
        return view('admin.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.type.create")->with(compact('categories'));
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
             'type' => 'required|unique:types'
        ]);
        if($request->hasFile('typeimage'))
        {
            $image = $request->file('typeimage');
            $filename  = time() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('type'),$filename);
        } 
        $type = new type;
        $type->category = $request->category;
        $type->subcategory = $request->subcategory;
        $type->subsubcategory = $request->subsubcategory;
        $type->type = $request->type;
        $type->typeimage = $filename;
        $type->save();
        return redirect('admin/type');
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
        $type = Type::find($id);
        return view('admin.type.edit',compact('type','categories','subcategories','subsubcategories'));
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
        if($request->hasFile('typeimage')){
            $image = $request->file('typeimage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('type'),$filename);
        } else {
            $type = Type::find($id);
            $filename = $type->typeimage;
        }
        $type = array(
            "category" => $request->category,
            "subcategory" => $request->subcategory,
            "subsubcategory" => $request->subsubcategory,
            "type" => $request->type,
            "typeimage" => $filename
        );
        type::where('id',$id)->update($type);
        return redirect('admin/type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Type::where('id',$id)->delete();
        return redirect('admin/type');
    }
    public function type_subcategory_data(Request $request)
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
    public function type_subsubcategory_data(Request $request)
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

    public function typestatus(Request $request)
    {
        $status = $request->status;
        $id = $request->type_id;
        $type = [
            "status" => $status
        ];
        Type::where("id",$id)->update($type);
    }
}
