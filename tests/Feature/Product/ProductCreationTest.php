<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\ProductFactory;
use \App\Product;
class ProductCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreation()
    {
        $productData = factory(Product::class)->make()->toArray();
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(201);
        $response->assertCreated();
        $response->assertJsonFragment($productData);
    }
    public function testCreationWithId()
    {
        $productData = factory(Product::class)->make()->toArray();
        $productData['id'] = 'randomId';
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
    }
    public function testCreationLackingName()
    {
        $productData = factory(Product::class)->make()->toArray();
        unset($productData['name']);
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
    public function testCreationEmptyName()
    {
        $productData = factory(Product::class)->make()->toArray();
        $productData['name'] = '';
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
    public function testCreationLackingQuantity()
    {
        $productData = factory(Product::class)->make()->toArray();
        unset($productData['quantity']);
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(201);
        $response->assertCreated();
        $response->assertJsonFragment($productData);
    }
    public function testCreationLackingBarcode()
    {
        $productData = factory(Product::class)->make()->toArray();
        unset($productData['barcode']);
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
    }
    public function testCreationWithEmptyBarcode()
    {
        $productData = factory(Product::class)->make()->toArray();
        $productData['barcode'] = '';
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
    }
    public function testCreationWithSameBarcode()
    {
        $product = factory(Product::class)->create();
        $product->save();
        $productData = $product->toArray();
        unset($productData['id']);
        $response = $this->post('/api/products', $productData);
        unset($productData['quantity']);
        $response->assertStatus(400);
        $response->assertJsonStructure(['error']);
    }
}
