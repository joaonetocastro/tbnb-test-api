<?php

namespace App\Managers\Movement;

use Carbon\Carbon;
use \App\Movement;
use \App\Product;

class GetProductMovementsManager
{
  public static function execute($productId)
  {
    $product = \App\Product::findOrFail($productId);
    return $product->movements;
  }
}
