<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Product;

class ProductRemoveTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $product = factory(Product::class)->create();
        $response = $this->delete('/api/products/'.$product->id);
        $response->assertStatus(200);
    }
    public function testDeleteNonExistingId()
    {
        $response = $this->delete('/api/products/RANDOM_ID');
        $response->assertStatus(404);
    }
}
