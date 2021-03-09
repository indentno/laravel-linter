<?php

namespace Admin\Http\Controllers;

class UserController
{
    public function index()
    {
        $users = User::get();

        return view('user.index', compact('users'));
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return view('user.show', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $this->validate(request()->all(), [
            'firstname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'firstname' => request()->firstname,
            'email' => request()->email,
            'password' => request()->password,
        ]);

        return redirect()->back()->with('success_message', 'User successfully created.');
    }
}
