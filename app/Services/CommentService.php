<?php

namespace App\Services;

use App\Models\Comment;

class CommentService implements ICommentService
{

    public function delete(int $id, int $productId): void
    {
        Comment::where('product_id', $productId)
            ->where('id', $id)->delete();
    }
}
