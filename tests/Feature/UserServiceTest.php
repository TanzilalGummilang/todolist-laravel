<?php

namespace Tests\Feature;

use App\Services\Interface\UserServiceInterface;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private UserServiceInterface $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        DB::delete("DELETE FROM users");
        $this->userService = $this->app->make(UserServiceInterface::class);
    }

    public function test_login_success()
    {
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userService->login("test@localhost", "test"));
    }

    public function test_login_user_not_found()
    {
        self::assertFalse($this->userService->login("test", "test"));
    }

    public function test_login_wrong_password()
    {
        self::assertFalse($this->userService->login("test", "wrongpass"));
    }
}
