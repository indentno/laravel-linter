<?php

namespace Admin\Http\Controllers;

class UserController
{
    public function index()
    {
        $users = User::get();

        return view('user.index', compact('users'));
    }
}
