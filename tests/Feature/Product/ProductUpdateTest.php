<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Product;

class ProductUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testUpdate()
    {
        
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $productData['name'] = 'random name';
        $response = $this->put('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'random name']);
    }
    public function testUpdateWithoutId()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $response = $this->put('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        unset($productData['id']);
        $response->assertJsonFragment($productData);
    
    }
    public function testUpdateWithQuantityChange()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $productData['quantity'] = $productData['quantity'] + 10;
        $response = $this->put('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        unset($productData['quantity']);
        $response->assertJsonFragment($productData);
    }
    public function testUpdateWithoutName()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        unset($productData['name']);
        $response = $this->put('/api/products/'.$product->id, $productData);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
    public function testUpdateWithoutBarcode()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        unset($productData['barcode']);
        $response = $this->put('/api/products/'.$product->id, $productData);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
    public function testUpdateWithExistingBarcode()
    {
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $productData = $product2->toArray();
        $productData['barcode'] = $product1->barcode;
        $response = $this->put('/api/products/'.$product2->id, $productData);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
    public function testUpdateWithNonexistingId()
    {
        $response = $this->put('/api/products/RANDOM_AND_NON_EXISTING_ID');
        $response->assertStatus(404);
    }
}
