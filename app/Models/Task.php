<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'status',
    ];

    public $timestamps = true;

    /**
     * Получить категорию, к которой относится задача
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}