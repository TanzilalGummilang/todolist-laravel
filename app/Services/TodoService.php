<?php

namespace App\Services;

use App\Models\Todo;
use App\Services\Interface\TodoServiceInterface;
use Illuminate\Support\Facades\Session;

class TodoService implements TodoServiceInterface
{
    public function saveTodo(int $userId, string $todo): void
    {
        $todo = new Todo([
            "user_id" => $userId,
            "todo" => $todo
        ]);

        $todo->save();
    }

    public function getAllTodos(): array
    {
        return Todo::query()->get()->toArray();
    }

    public function getTodoById(int $id): Todo
    {
        return Todo::query()->find($id);
    }

    public function getTodos(int $userId): array
    {
        return Todo::query()->where('user_id', $userId)->get()->toArray();
    }

    public function updateTodo(int $id, string $todo): void
    {
        $currentTodo = Todo::query()->find($id);
        if($currentTodo != null){
            $currentTodo->todo = $todo;
            $currentTodo->save();
        }
    }

    public function removeTodo(int $id): void
    {
        $todo = Todo::query()->find($id);
        if($todo != null){
            $todo->delete();
        }
    }
}
