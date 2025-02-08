<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Comment;
use App\Models\Product;
use App\Services\IProductService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected IProductService $service)
    {
    }

    public function index()
    {
       // $this->authorize('viewAny', Product::class);

        return ProductResource::collection(Product::all());
    }


    public function show(Product $product)
    {
        //$this->authorize('view', $product);

        return new ProductResource($product);
    }

    public function addComment(Product $product, CommentRequest $request)
    {
        $product->comments()->save(
            new Comment([
                'comment' => $request->getComment(),
                'rating' => $request->getRating(),
            ])
        );

        return new ProductResource($product);
    }

}
