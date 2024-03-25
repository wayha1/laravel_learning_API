<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Product::class, 'product');
    }
    //
    public function index(Request $request)
    {
        // return response()->json(Product::all());
        // $products = Product::all();
        // return view('products.index', ['products' => $products]);
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(['is_done', 'id'])
            ->defaultSort('.created_at')
            ->allowedSorts(['product_name', 'is_done', 'created_at'])
            ->paginate();

        return new ProductCollection($products);
    }

    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = Auth::user()->products()->create($validated);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return new ProductResource($product);
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

    // public function create()
    // {
    //     return view('products.create');
    // }
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'product_name' => 'required|string|max:255',
    //         'product_type' => 'required|string|max:255',
    //         'product_brand' => 'required|string|max:255',
    //         'product_price' => 'required|numeric',
    //         'product_ingredient' => 'required|string|max:255',
    //         'product_stock' => 'required|integer',
    //     ]);

    //     // Create a new product using the validated data
    //     $product = Product::create($validatedData);
    //     return redirect()->route('products.index')->with('success', 'Product created successfully.');
    // }
    // public function edit(Product $product)
    // {
    //     return view('products.edit', ['product' => $product]);
    // }
}
