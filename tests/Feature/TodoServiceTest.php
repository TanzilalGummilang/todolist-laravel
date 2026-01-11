<?php

namespace Tests\Feature;

use App\Services\Interface\TodoServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class TodoServiceTest extends TestCase
{
    private TodoServiceInterface $todoService;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete('DELETE FROM todos');
        $this->todoService = $this->app->make(TodoServiceInterface::class);
    }

    public function test_todos_not_null()
    {
        self::assertNotNull($this->todoService);
    }

    public function test_save_todo()
    {
        $this->todoService->saveTodo('Sleep');

        $todos = $this->todoService->getTodos();
        foreach ($todos as $value) {
            self::assertEquals('Sleep', $value['todo']);
        }
    }

    public function test_get_todos_empty()
    {
        self::assertEquals([], $this->todoService->getTodos());
    }

    public function test_get_todos_not_empty()
    {
        $expected = [
            [
                'todo' => 'Sleep'
            ],
            [
                'todo' => 'Eat Catfish Pecel'
            ]
        ];

        $this->todoService->saveTodo('Sleep');
        $this->todoService->saveTodo('Eat Catfish Pecel');

        Assert::assertArraySubset($expected, $this->todoService->getTodos());
    }

    public function test_remove_todo()
    {
        $this->todoService->saveTodo('Sleep');
        $this->todoService->saveTodo('Eat Catfish Pecel');

        $todos = $this->todoService->getTodos();
        self::assertEquals(2, sizeof($todos));

        $todoIds = array_map(function ($todo) {
            return $todo['id'];
        }, $todos);

        $this->todoService->removeTodo($todoIds[0]);

        $todosAfterDeletion = $this->todoService->getTodos();
        self::assertEquals(1, sizeof($todosAfterDeletion));
        self::assertNotEquals(0, sizeof($todosAfterDeletion));
        self::assertNotEquals(2, sizeof($todosAfterDeletion));
    }
}
