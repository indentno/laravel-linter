<?php

namespace Admin\Http\Controllers;

class PageController
{
    public function index()
    {
        $pages = Page::get();

        return view('page.index', compact('pages'));
    }

    public function filter()
    {
        $pages = Page::search(request('title'))->get();

        return view('page.index', compact('pages'));
    }

    public function show($pageId)
    {
        $page = Page::findOrFail($pageId);

        return view('page.show', compact('page'));
    }

    public function create()
    {
        return view('page.create');
    }

    public function edit($pageId)
    {
        $page = Page::findOrFail($pageId);

        return view('page.edit', compact('page'));
    }
}
