<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreProduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index',compact('products'));

    }
    public function trashProductList()
    {
        $create = 1;
        $products = Product::onlyTrashed()->paginate(5);
        // return $categories;
        return view('admin.products.index',compact('products','create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        // return $categories;

        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        // dd($request->all());
        if($request->hasFile('thumbnail')){
            $location = 'public/images/products/';
            $extension = '.'.$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(),$extension).time();
            $name = $name.$extension;
            $name = $location.$name;
            $path = $request->thumbnail->move($location,$name);
        }
        $product =  Product::create([
                        'title' => $request->title,
                        'slug' =>$request->slug,
                        'description' =>$request->description,
                        'thumbnail' =>  $name,
                        'status' => $request->status,
                        'featured' => $request->featured ? $request->featured :0,
                        'price' =>$request->price,
                        'discount' =>$request->discount ? $request->discount : 0,
                        'options' =>isset($request->extras) ? json_encode($request->extras) : null,
                        'discount_price' =>$request->discount_price ? $request->discount_price :0 ,
                    ]);
        if($product){
            $product->catagories()->attach($request->category_id);
            return back()->with('message','Product Added Suceessfully');
        }
        else{
            return back()->with('message','Error While Adding Product');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        $products =Product::paginate(6);
        return view('products.all',compact('categories','products'));
    }

    //Show Single Product
    public function singleProduct(Product $product)
    {
        return view('products.single',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        // dd($product);
        return view('admin.products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {
        // dd($request->all());
        if($request->has('thumbnail')){
            $location = 'public/images/products/';
            $extension = '.'.$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(),$extension).time();
            $name = $name.$extension;
            $name = $location.$name;
            $path = $request->thumbnail->move($location,$name);
            $product->thumbnail = $name;
        }
        $product->title = $request->title;
        $product->slug =  $request->slug;
        $product->description =$request->description;
        $product->status = $request->status;
        $product->featured = $request->featured ? $request->featured :0;
        $product->price =$request->price;
        $product->discount =$request->discount ? $request->discount :0;
        $product->discount_price =$request->discount_price ? $request->discount_price :0;
        $product->catagories()->detach();
        $product->catagories()->attach($request->category_id);
        if($product->save()){
            return back()->with('message','Product Update Suceessfully');
        }
        else{
            return back()->with('message','OOPs... Something Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $product;
        die;
        if($product->forceDelete())
        {
            $product->catagories()->detach();
            Storage::delete($product->thumbnail);
            return back()->with('message' ,'Record Successfully Deleted!!');
        }
        else{
            return back()->with('message' ,'Oops Something Worng......');
        }
    }


    public function removeToTrashProduct(Product $product)
    {
    // softdelete the record(available in database) ;
        if($product->delete())
        {
            return back()->with('message' ,'Record Successfully Trashed!!');
        }
        else{
            return back()->with('message' ,'Oops... Something Worng.....');
        }
    }
    //restore the product list
    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        if($product->restore())
            return back()->with('message','Product Successfully Restored!');
        else
            return back()->with('message','Error Restoring Product');
    }
}
