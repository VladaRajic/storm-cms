<?php

namespace App\Services;

interface ICommentService
{
    public function delete(int $id, int $productId): void;
}
