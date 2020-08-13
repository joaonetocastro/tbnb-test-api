<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Movement;
use \App\Product;
class MovementsController extends Controller
{
    public function getAll($productId, Request $request){
        try{
            $product = \App\Product::findOrFail($productId);
            return response()->json($product->movements, 200);
        }catch(\Error $error){
            return response()->json(404);
        }
    }
    public function store(Request $request)
    {
        $movementData = $request->all();
        $currentDate = Carbon::now()->toDateTimeString();
        $movement = Movement::create(['type' => $movementData['type'], 'date'=> $currentDate ]);
        // dd($movementData['products']);
        $products = [];
        foreach($movementData['products'] as $product){
            $products[$product['id']] = ["quantity" => $product["quantity"]];
        }
        foreach($movementData['newProducts'] as $productData){
            $product = Product::create($productData);
            $products[$product['id']] = ["quantity" => $product["quantity"]];
        }
        // dd($products);
        $movement->products()->attach($products);
        foreach($movementData['products'] as $productData){
            $product = Product::find($productData['id']);
            if($movement->type == 'in'){
                $product->quantity += $productData['quantity'];
            }else{
                $product->quantity -= $productData['quantity'];    
            }
            $product->save();
        }
        // dd($movement->products);
        return response()
        ->json($movement, 200);
    }
}
