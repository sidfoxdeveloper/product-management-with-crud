<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\AUth;
use Illuminate\Support\ViewErrorBag;
use Validator,Redirect,Response,File;
use App\User;
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
        $errors = Product::orderBy('id', 'desc')->paginate(5);
        return view( 'products.index', ['errors'=>$errors] )->with( 'i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'products.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $user)
    {
        //Validation
        $request->validate([ 'user_id'=>'required', 'title'=>'required', 'description'=>'required' ]);
        
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($files = $request->file('image')) {
           $destinationPath = base_path().'public/uploads/'; // upload path           
           $profileImage = date('Y-m-d-His')."-". $files->getClientOriginalName();
           $files->move($destinationPath, $profileImage);
        }
        
        //Insert record
        $product::create($request->all());
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', ['product'=>$product] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product'=>$product] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([ 'title'=>'required', 'description'=>'required' ]);
        
        $product->update($request->all());
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        
        $product->delete($request->product_id);
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    
}