<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
       // $this->authorize('viewAny', Category::class);

        return CategoryResource::collection(Category::all());
    }


    public function show(Category $category)
    {
       // $this->authorize('view', $category);

        return new CategoryResource($category);
    }
}
