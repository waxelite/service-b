<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    /**
     * Получить все задачи.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Task::all();
    }

    /**
     * Получить задачу по ID.
     *
     * @param  int  $id
     * @return Task|null
     */
    public function getById(int $id): ?Task
    {
        return Task::find($id);
    }

    /**
     * Создать новую задачу.
     *
     * @param  array  $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * Обновить задачу по ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return Task|null
     */
    public function update(int $id, array $data): ?Task
    {
        $task = Task::find($id);

        if (!$task) {
            return null;
        }

        $task->update($data);

        return $task;
    }

    /**
     * Удалить задачу по ID.
     *
     * @param  int  $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $task = Task::find($id);

        return $task ? $task->delete() : false;
    }

    /**
     * Получить все задачи по категории.
     *
     * @param  int  $categoryId
     * @return Collection
     */
    public function getTasksByCategory(int $categoryId): Collection
    {
        return Task::where('category_id', $categoryId)->get();
    }
}

