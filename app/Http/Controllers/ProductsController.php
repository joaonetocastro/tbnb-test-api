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
        $products = \App\Managers\Product\ListProductsManager::execute();
        return response()->json($products,200);
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
        try {
            $product = \App\Managers\Product\CreateProductManager::execute($productData);
            return response()
                ->json($product, 201);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($productId, Request $request)
    {

        $productData = $request->all();
        try {
            $product = \App\Managers\Product\UpdateProductManager::execute($productId, $productData);
            return response()
                ->json($product, 200);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        try {
            \App\Managers\Product\DeleteProductManager::execute($productId);
            return response(200);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 404);
        }
    }
}
