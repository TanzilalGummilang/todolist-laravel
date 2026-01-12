<?php

namespace App\Services\Interface;

use App\Models\Todo;

interface TodoServiceInterface
{
    public function saveTodo(int $userId, string $todo): void;
    public function updateTodo(int $id, string $todo): void;
    public function getAllTodos(): array;
    public function getTodoById(int $id): Todo;
    public function getTodos(int $userId): array;
    public function removeTodo(int $id): void;
}