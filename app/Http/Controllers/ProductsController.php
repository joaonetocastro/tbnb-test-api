<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
        // return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productData = $request->all();
        if(isset($productData['id'])){
            return response()->json(['error' => 'PRODUCT_HAS_ID'], 400);
        } 
        if(empty($productData['name'])){
            return response()->json(['error' => 'EMPTY_NAME'], 400);
        }
        if($productData['barcode'] && Product::where('barcode', $productData['barcode'])->first()){
            return response()->json(['error' => 'BARCODE_EXISTS'], 400);
        }
        $product = Product::create($productData);
        return response()
        ->json($product, 201);
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
        $productData = $request->all();
        if(empty($productData['name'])){
            return response()->json(['error' => 'EMPTY_NAME'], 400);
        }

        $product->name = $productData['name'];
        $product->save();
        return response()
        ->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
