<?php

namespace App\Http\Controllers;

use App\Services\Interface\TodoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    private TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $user = Auth::user();

        return response()->view('todos.index', [
            'title' => 'Todos',
            'user' => $user,
            'todos' => $this->todoService->getTodos($user->id)
        ]);
    }

    public function addTodo(Request $request)
    {
        $user = Auth::user();
        $todo = $request->input('todo');

        if (empty($todo)) {
            return response()->view('todos.index', [
                'title' => 'Todos',
                'todos' => $this->todoService->getTodos($user->id),
                'error' => 'Todo is required'
            ]);
        }

        $this->todoService->saveTodo($user->id, $todo);

        return redirect()->route('todos.index');
    }

    public function edit(int $id)
    {
        $user = Auth::user();
        
        return response()->view('todos.edit', [
            'title' => 'Edit Todo',
            'todos' => $this->todoService->getTodos($user->id),
            'selectedTodo' => $this->todoService->getTodoById($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $user = Auth::user();
        $todo = $request->input('todo');

        if (empty($todo)) {
            return response()->view('todos.edit', [
                'title' => 'Edit Todo',
                'todos' => $this->todoService->getTodos($user->id),
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
