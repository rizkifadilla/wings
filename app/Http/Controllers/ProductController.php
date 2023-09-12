<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \App\Product::all();
        return view('/product/view',compact('products'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new \App\Product;
        $product->productCode = Str::random(6);
        $product->productName = $request->get('productName');
        $product->price = $request->get('price');
        $product->currency = $request->get('currency');
        $product->discount = $request->get('discount');
        $product->dimension = $request->get('dimension');
        $product->unit = $request->get('unit');
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);

        $product->image = $imageName;
        $product->save();
        
        return redirect('products')->with('success', 'Product data has been added'); 
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
    public function edit($productCode)
    {
        $product = \App\Product::where('productCode', $productCode)->first();
        return view('/product/edit',compact('product','productCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productCode)
    {
        \App\Product::where('productCode', $productCode)
            ->update([
                'productName' => $request->get('productName'),
                'price' => $request->get('price'),
                'currency' => $request->get('currency'),
                'discount' => $request->get('discount'),
                'dimension' => $request->get('dimension'),
                'unit' => $request->get('unit'),
                'image' => 'IMAGE',
            ]);

        return redirect('products')->with('success', 'Product data has been changed');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCode)
    {
        \App\Product::where('productCode', $productCode)->delete();

        return redirect('products')->with('success','Product data has been deleted');
    }
}
