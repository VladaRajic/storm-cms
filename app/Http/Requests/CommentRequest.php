<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{

    const COMMENT = 'comment';
    const RATING = 'rating';
    public function rules(): array
    {
        return [
            self::COMMENT => 'required',
            self::RATING => 'required|int'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getComment(): string
    {
        return $this->input(self::COMMENT);
    }

    public function getRating(): string
    {
        return $this->input(self::RATING);
    }
}
