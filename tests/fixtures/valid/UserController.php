<?php

namespace Admin\Http\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::get();

        return view('user.index', ['users' => $users]);
    }
}
