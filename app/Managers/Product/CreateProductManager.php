<?php

namespace App\Managers\Product;

use App\Product;

class CreateProductManager
{
  public static function execute($productData)
  {
    // unset($productData['quantity']);
    if (isset($productData['id'])) {
      throw new \Exception('PRODUCT_HAS_ID');
    }
    if (empty($productData['name'])) {
      throw new \Exception('EMPTY_NAME');
    }
    if ($productData['barcode'] && Product::where('barcode', $productData['barcode'])->first()) {
      throw new \Exception('BARCODE_EXISTS');
    }
    if (
      strlen($productData['barcode']) !== 0
      && strlen($productData['barcode']) !== 12
      && strlen($productData['barcode']) !== 14
    ) {
      throw new \Exception('INVALID_BARCODE');
    }
    $product = Product::create($productData);
    return $product;
  }
}
