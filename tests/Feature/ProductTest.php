<?php

use App\Models\Product;

test('products list when there is success', function () {
    Product::factory()->count(10)->create();

    $response = $this->get('/products');

    $response->assertOk();
    $response->assertJsonCount(10);
});
test('products list with search by term', function () {
    Product::factory()->count(10)->create();
    Product::factory()->create(['name' => 'test product xpto']);

    $response = $this->get('/products?search=xpto');

    $response->assertOk();
    $response->assertJsonCount(1);
});
test('products list with sorting by price', function () {
    Product::factory()->create([
        ['name' => 'C', 'price' => 20],
        ['name' => 'B', 'price' => 30],
        ['name' => 'A', 'price' => 40],
    ]);

    $response = $this->get('/products?order=desc');

    $response->assertOk();
    $response->assertJsonFragment([
        ['name' => 'A', 'price' => 40],
        ['name' => 'B', 'price' => 30],
        ['name' => 'C', 'price' => 20]
    ]);
});
test('products list with limit', function () {
    Product::factory()->count(10)->create();

    $response = $this->get('/products?limit=2');

    $response->assertOk();
    $response->assertJsonCount(2);
});
test('products list when limit value is greather than 50', function () {
    $response = $this->get('/products?limit=100');

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors('limit');
});


