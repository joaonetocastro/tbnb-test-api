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
        $productData = factory(Product::class)->make()->toArray();
        $product = Product::create($productData);
        $productData['name'] = 'random name';
        $response = $this->putJson('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        $response->assertJsonFragment($productData);
    }
    public function testUpdateWithoutId()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $response = $this->putJson('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        unset($productData['id']);
        $response->assertJsonFragment($productData);
    
    }
    public function testUpdateWithQuantityChange()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $productData['quantity'] = $productData['quantity'] + 10;
        $response = $this->putJson('/api/products/'.$product->id, $productData);
        $response->assertStatus(200);
        unset($productData['quantity']);
        $response->assertJsonFragment($productData);
    }
    public function testUpdateWithNonexistingId()
    {
        $response = $this->putJson('/api/products/RANDOM_AND_NON_EXISTING_ID');
        $response->assertStatus(404);
    }
}
