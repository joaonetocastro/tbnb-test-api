<?php

namespace Tests\Feature\Movement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Product;
class ListMovements extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $products = array();
        foreach(range(1,10) as $i){
            $product = factory(Product::class)->create();
            array_push($products, $product->toArray());
        }
        $movementData = ["type" => "in", 'products' => $products];
        $this->postJson('/api/movements', $movementData);
        $response = $this->get('/api/movements/'.$products[1]['id']);
        $response->assertStatus(200);
    }
    public function testInvalidId()
    {
        $response = $this->get('/api/movements/INVALID_ID');
        $response->assertStatus(404);
    }
}
