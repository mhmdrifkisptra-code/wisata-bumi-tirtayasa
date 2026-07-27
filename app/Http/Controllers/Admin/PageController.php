<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('slug')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['nullable','string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diupdate.');
    }
}
