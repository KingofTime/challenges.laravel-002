<?php

use App\Models\Product;

test('products list when there is success', function () {
    Product::factory()->count(10)->create();

    $response = $this->get('/api/products');

    $response->assertOk();
    $response->assertJsonCount(10);
});
test('products list with search by term', function () {
    Product::factory()->count(10)->create();
    Product::factory()->create(['name' => 'test product xpto']);

    $response = $this->get('/api/products?search=xpto');

    $response->assertOk();
    $response->assertJsonCount(1);
});
test('products list with sorting by price', function () {
    Product::factory()->create(['name' => 'C', 'price' => 20]);
    Product::factory()->create(['name' => 'B', 'price' => 30]);
    Product::factory()->create(['name' => 'A', 'price' => 40]);

    $response = $this->get('/api/products?order=desc');

    $response->assertOk();
    $this->assertEquals(40, $response->json('0.price'));
});
test('products list with limit', function () {
    Product::factory()->count(10)->create();

    $response = $this->get('/api/products?limit=2');

    $response->assertOk();
    $response->assertJsonCount(2);
});
test('products list when limit value is greather than 50', function () {
    $response = $this->get('/api/products?limit=100');

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});
