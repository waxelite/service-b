<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Получить все категории.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * Получить категорию по ID.
     *
     * @param  int  $id
     * @return Category|null
     */
    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Создать новую категорию.
     *
     * @param  array  $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Обновить категорию по ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return Category|null
     */
    public function update(int $id, array $data): ?Category
    {
        $category = Category::find($id);

        if (!$category) {
            return null;
        }

        $category->update($data);

        return $category;
    }

    /**
     * Удалить категорию по ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $category = Category::find($id);

        return $category ? $category->delete() : false;
    }
}
