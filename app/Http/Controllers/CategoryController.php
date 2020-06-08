<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create = 0;
        $categories = Category::paginate(5);
        // return $categories;
        return view('admin.categories.index',compact('categories','create'));
    }
    /**
     * Display a Trash of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $create = 1;
        $categories = Category::onlyTrashed()->paginate(5);
        // return $categories;
        return view('admin.categories.index',compact('categories','create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|unique:categories|max:255',
            'description'=> 'max:255',
        ]);

        $categories = Category::create($request->only('title','description','slug'));
        $categories->childrens()->attach($request->parent_id);
        return back()->with('message',"Categories Successfully Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id','!=',$category->id)->get();
        return view('admin.categories.edit',['categories' => $categories ,'category'=> $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation of required feild
        $request->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'description'=> 'max:255',
        ]);

        //form request data insert throught depandency injection
        $category->title       = $request->title;
        $category->description = $request->description;
        $category->slug        = $request->slug;
        //detach the parent categories previous Records
        $category->childrens()->detach();
        //attached select parent category record
        $category->childrens()->attach($request->parent_id);
        $category->save();
        return back()->with('message' ,'Record Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete Permanent from the database
      if($category->childrens()->detach() && $category->forceDelete())
      {
        return back()->with('message' ,'Record Successfully Deleted!!');
      }
      else{
        return back()->with('message' ,'Oops Something Worng......');
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function remove(Category $category)
    {
    // softdelete the record(available in database) ;
      if($category->delete())
      {
        return back()->with('message' ,'Record Successfully Trashed!!');
      }
      else{
        return back()->with('message' ,'Oops... Something Worng.....');
      }
    }

    //for restore function
    public function restoreData($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore())
            return back()->with('message','Category Successfully Restored!');
        else
            return back()->with('message','Error Restoring Category');
    }
}

