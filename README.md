
# Lumen Task and Category API

This project provides an API built with **Lumen** to manage tasks and categories. It allows you to perform CRUD operations on tasks and categories, including retrieving tasks by category.

## Endpoints

### Tasks

#### 1. Get all tasks
```http
GET /api/tasks
```
- Returns a list of all tasks.

#### 2. Get task by ID
```http
GET /api/tasks/{id}
```
- Returns a single task by its ID.

#### 3. Create a new task
```http
POST /api/tasks
```
- Request Body:
```json
{
  "title": "Task title",
  "description": "Task description",
  "category_id": 1
}
```
- Creates a new task with the provided data.

#### 4. Update a task by ID
```http
PUT /api/tasks/{id}
```
- Request Body:
```json
{
  "title": "Updated task title",
  "description": "Updated task description",
  "category_id": 1
}
```
- Updates the task with the provided ID.

#### 5. Delete a task by ID
```http
DELETE /api/tasks/{id}
```
- Deletes the task with the specified ID.

#### 6. Get tasks by category
```http
GET /api/tasks/categories/{categoryId}
```
- Returns a list of tasks for a specific category ID.

---

### Categories

#### 1. Get all categories
```http
GET /api/categories
```
- Returns a list of all categories.

#### 2. Get category by ID
```http
GET /api/categories/{id}
```
- Returns a single category by its ID.

#### 3. Create a new category
```http
POST /api/categories
```
- Request Body:
```json
{
  "name": "Category name"
}
```
- Creates a new category with the provided name.

#### 4. Update a category by ID
```http
PUT /api/categories/{id}
```
- Request Body:
```json
{
  "name": "Updated category name"
}
```
- Updates the category with the specified ID.

#### 5. Delete a category by ID
```http
DELETE /api/categories/{id}
```
- Deletes the category with the specified ID.
