<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedIncludes('products')
            ->paginate();
        return new CategoryCollection($categories);
    }
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Auth::user()->categories()->create($validated);

        return new CategoryResource($category);
    }

    public function show(Request $request, Category $category)
    {
        return (new CategoryResource($category))->load('products');
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);
        return new CategoryResource($category);
    }

    public function destory(Request $request, Category $category)
    {
        $category->delete();
        
        return response()->noContent();
    }
}
