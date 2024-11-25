<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    /**
     * Получить задачи, принадлежащие категории
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}