<?php

namespace App\Services\Interface;

use App\Models\Todo;

interface TodoServiceInterface
{
    public function saveTodo(string $todo): void;
    public function updateTodo(int $id, string $todo): void;
    public function getTodos(): array;
    public function getTodoById(int $id): Todo;
    public function removeTodo(int $id): void;
}