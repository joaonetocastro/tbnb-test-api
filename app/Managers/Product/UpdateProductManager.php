<?php

namespace App\Managers\Product;

use Carbon\Carbon;
use \App\Movement;
use \App\Product;

class UpdateProductManager
{
  public static function execute($productId, $productData)
  {
    unset($productData['quantity']);
    if (empty($productData['name'])) {
      throw new \Exception('EMPTY_NAME');
    }
    if (empty($productData['barcode'])) {
      throw new \Exception('EMPTY_BARCODE');
    }

    if ($productData['barcode'] && Product::where([
      ['barcode', '=', $productData['barcode']],
      ['id', '!=', $productId]
    ])->first()) {
      throw new \Exception('BARCODE_EXISTS');
    }
    if (
      strlen($productData['barcode']) !== 0
      && strlen($productData['barcode']) !== 12
      && strlen($productData['barcode']) !== 14
    ) {
      throw new \Exception('INVALID_BARCODE');
    }
    $product = Product::findOrFail($productId);
    $product->fill($productData);
    $product->save();
    return $product;
  }
}
