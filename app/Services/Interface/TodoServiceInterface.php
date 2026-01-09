<?php

namespace App\Services\Interface;

interface TodoServiceInterface
{
    public function saveTodo(string $todo): void;
    public function getTodos(): array;
    public function removeTodo(int $id): void;
}