<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryRequest
{
    /**
     * Валидация для создания категории.
     */
    public static function validateCreate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
    }

    /**
     * Валидация для обновления категории.
     */
    public static function validateUpdate(Request $request, int $categoryId): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
    }
}
