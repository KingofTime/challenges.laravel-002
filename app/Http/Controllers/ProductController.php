<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    const int DEFAULT_LIMIT_VALUE = 50;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $query = Product::query();
        $query->when($validated['search'] ?? null, function ($query, $search) {
            return $query->where('name', 'ilike', '%'.$search.'%');
        });
        $query->when($validated['order'] ?? null, function ($query, $order) {
            return $query->orderBy('price', $order);
        });
        $products = $query->paginate($validated['limit'] ?? self::DEFAULT_LIMIT_VALUE);

        return response()->json(ProductResource::collection($products));
    }
}
