<?php

namespace App\Managers\Movement;

use Carbon\Carbon;
use \App\Movement;
use \App\Product;
use Illuminate\Support\Facades\DB;

class CreateMovementManager
{
  public static function execute($movementData)
  {
    try {
      $currentDate = Carbon::now()->toDateTimeString();
      DB::beginTransaction();
      $movement = Movement::create(['type' => $movementData['type'], 'date' => $currentDate]);
      $products = [];
      foreach ($movementData['products'] as $product) {
        $products[$product['id']] = ["quantity" => $product["quantity"]];
      }
      foreach ($movementData['newProducts'] as $productData) {
        $product = \App\Managers\Product\CreateProductManager::execute($productData);
        $products[$product['id']] = ["quantity" => $product["quantity"]];
      }
      $movement->products()->attach($products);
      foreach ($movementData['products'] as $productData) {
        $product = Product::find($productData['id']);
        if ($movement->type == 'in') {
          $product->quantity += $productData['quantity'];
        } else {
          $product->quantity -= $productData['quantity'];
        }
        $product->save();
      }
      DB::commit();
      return $movement;
    } catch (\Exception $error) {
      DB::rollBack();
      throw $error;
    }
  }
}
