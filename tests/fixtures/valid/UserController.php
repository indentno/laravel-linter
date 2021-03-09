<?php

namespace Admin\Http\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = $this->getUsers();

        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->back()->with('success_message', 'User successfully created.');
    }

    private function getUsers()
    {
        return User::get();
    }
}
