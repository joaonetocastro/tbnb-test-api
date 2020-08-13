<?php

namespace App\Managers\Product;

use Carbon\Carbon;
use \App\Movement;
use \App\Product;

class ListProductsManager
{
  public static function execute()
  {
    $products = Product::all();
    return $products;
  }
}
