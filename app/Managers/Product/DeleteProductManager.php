<?php

namespace App\Managers\Product;

use Carbon\Carbon;
use \App\Movement;
use \App\Product;

class DeleteProductManager
{
  public static function execute($productId)
  {
    $product = \App\Product::findOrFail($productId);
    $product->delete();
  }
}
