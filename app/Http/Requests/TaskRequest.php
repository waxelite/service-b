<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskRequest
{
    /**
     * Валидация для создания задачи.
     */
    public static function validateCreate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|string|in:pending,completed',
            'category_id' => 'nullable|exists:categories,id',
        ]);
    }

    /**
     * Валидация для обновления задачи.
     */
    public static function validateUpdate(Request $request, int $taskId): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,completed',
            'category_id' => 'nullable|exists:categories,id',
        ]);
    }
}
