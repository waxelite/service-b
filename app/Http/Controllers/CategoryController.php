<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Возвращает список всех категорий.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = $this->categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    /**
     * Возвращает данные конкретной категории.
     *
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function show(int $id): CategoryResource|JsonResponse
    {
        $category = $this->categoryService->getById($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return new CategoryResource($category);
    }

    /**
     * Создаёт новую категорию.
     *
     * @param Request $request
     * @return CategoryResource|JsonResponse
     */
    public function store(Request $request): CategoryResource|JsonResponse
    {
        $validator = CategoryRequest::validateCreate($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = $this->categoryService->create($request->all());

        return new CategoryResource($category);
    }

    /**
     * Обновляет данные категории.
     *
     * @param Request $request
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function update(Request $request, int $id): CategoryResource|JsonResponse
    {
        $validator = CategoryRequest::validateUpdate($request, $id);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = $this->categoryService->update($id, $request->all());

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return new CategoryResource($category);
    }

    /**
     * Удаляет категорию.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->categoryService->delete($id);

        if (!$deleted) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
