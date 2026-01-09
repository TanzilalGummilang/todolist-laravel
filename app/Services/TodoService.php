<?php

namespace App\Services;

use App\Models\Todo;
use App\Services\Interface\TodoServiceInterface;
use Illuminate\Support\Facades\Session;

class TodoService implements TodoServiceInterface
{
    public function saveTodo(string $todo): void
    {
        $todo = new Todo([
            "todo" => $todo
        ]);
        $todo->save();
    }

    public function getTodos(): array
    {
        return Todo::query()->get()->toArray();
    }

    public function removeTodo(int $id): void
    {
        $todo = Todo::query()->find($id);
        if($todo != null){
            $todo->delete();
        }
    }
}
