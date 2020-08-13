<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\ProductFactory;
use Tests\TestCase;
use \App\Product;
class MovementBulkAddTest extends TestCase
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
        $movementData = ["type" => "in", 'products' => $products, 'newProducts' => []];
        $response = $this->postJson('/api/movements', $movementData);
        $response->assertStatus(200);
    }
}
