<?php

namespace App\Http\Controllers;

use App\Services\Interface\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view('users.login', [
                'title' => 'Login'
            ]);
    }

    public function doLogin(Request $request): Response | RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if (empty($user) || empty($password)) {
            return response()->view('users.login', [
                'title' => 'Login',
                'error' => 'Email or Password is required!'
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('users.login', [
            'title' => 'Login',
            'error' => 'Email or Password is wrong!'
        ]);
    }

    public function doLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
