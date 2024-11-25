<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Возвращает список всех задач.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $tasks = $this->taskService->getAll();

        return TaskResource::collection($tasks);
    }

    /**
     * Возвращает данные конкретной задачи.
     *
     * @param int $id
     * @return TaskResource|JsonResponse
     */
    public function show(int $id): TaskResource|JsonResponse
    {
        $task = $this->taskService->getById($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return new TaskResource($task);
    }

    /**
     * Создаёт новую задачу.
     *
     * @param Request $request
     * @return TaskResource|JsonResponse
     */
    public function store(Request $request): TaskResource|JsonResponse
    {
        $validator = TaskRequest::validateCreate($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $task = $this->taskService->create($request->all());

        return new TaskResource($task);
    }

    /**
     * Обновляет данные задачи.
     *
     * @param Request $request
     * @param int $id
     * @return TaskResource|JsonResponse
     */
    public function update(Request $request, int $id): TaskResource|JsonResponse
    {
        $validator = TaskRequest::validateUpdate($request, $id);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $task = $this->taskService->update($id, $request->all());

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return new TaskResource($task);
    }

    /**
     * Удаляет задачу.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->taskService->delete($id);

        if (!$deleted) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
     * Возвращает все задачи по категории.
     *
     * @param int $categoryId
     * @return JsonResponse
     */
    public function getTasksByCategory(int $categoryId): JsonResponse
    {
        $tasks = $this->taskService->getTasksByCategory($categoryId);

        if ($tasks->isEmpty()) {
            return response()->json(['error' => 'No tasks found for this category'], 404);
        }

        return response()->json(['tasks' => $tasks], 200);
    }
}
