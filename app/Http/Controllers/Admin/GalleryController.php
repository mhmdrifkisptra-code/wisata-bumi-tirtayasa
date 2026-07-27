<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::orderBy('sort_order')->latest()->paginate(12);
        return view('admin.galeri.index', compact('items'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'caption' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable'],
            'image' => ['required','image','mimes:jpg,jpeg,png,webp','max:3072'],
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['image'] = $request->file('image')->store('galeri', 'public');

        Gallery::create($data);

        return redirect()->route('admin.galeri.index')->with('success','Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Gallery $galeri)
    {
        $data = $request->validate([
            'title' => ['nullable','string','max:255'],
            'caption' => ['nullable','string'],
            'sort_order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:3072'],
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($galeri->image);
            $data['image'] = $request->file('image')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success','Galeri berhasil diupdate.');
    }

    public function destroy(Gallery $galeri)
    {
        Storage::disk('public')->delete($galeri->image);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success','Foto galeri berhasil dihapus.');
    }
}
