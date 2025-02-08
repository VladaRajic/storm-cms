<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const PRICE = 'price';
    const CATEGORIES = 'categories';
    const IMAGES = 'images';
    const MAIN_IMAGE = 'main_image';
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return $this->input(self::NAME);
    }

    public function getDescription(): string
    {
        return $this->input(self::DESCRIPTION);
    }

    public function getPrice(): string
    {
        return $this->input(self::PRICE);
    }

    public function getCategories(): array
    {
        return $this->input(self::CATEGORIES);
    }

    public function getImages(): array
    {
        return $this->input(self::IMAGES);
    }
    public function getMainImage(): string
    {
        return $this->input(self::MAIN_IMAGE);
    }
}
