<?php

namespace App\Http\Controllers;

use App\Services\Interface\TodoServiceInterface;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    private TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        return response()->view('todos.index', [
            'title' => 'Todos',
            'todos' => $this->todoService->getTodos()
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            return response()->view('todos.index', [
                'title' => 'Todos',
                'todos' => $this->todoService->getTodos(),
                'error' => 'Todo is required'
            ]);
        }

        $this->todoService->saveTodo($todo);

        return redirect()->action([TodoController::class, 'index']);
    }

    public function edit(int $id)
    {
        return response()->view('todos.edit', [
            'title' => 'Edit Todo',
            'todos' => $this->todoService->getTodos(),
            'selectedTodo' => $this->todoService->getTodoById($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            return response()->view('todos.edit', [
                'title' => 'Edit Todo',
                'todos' => $this->todoService->getTodos(),
                'selectedTodo' => $this->todoService->getTodoById($id),
                'error' => 'Todo is required'
            ]);
        }

        $this->todoService->updateTodo($id, $todo);

        return redirect()->action([TodoController::class, 'index']);
    }
    
    public function removeTodo(string $id)
    {
        $this->todoService->removeTodo($id);
        return redirect()->action([TodoController::class, 'index']);
    }
}
