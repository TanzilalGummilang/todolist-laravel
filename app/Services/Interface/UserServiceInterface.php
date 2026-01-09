<?php

namespace App\Services\Interface;

interface UserServiceInterface
{
    public function login(string $email, string $password): bool;
}