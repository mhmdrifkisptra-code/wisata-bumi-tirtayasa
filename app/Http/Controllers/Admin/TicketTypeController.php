<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $tickets = TicketType::latest()->paginate(10);
        return view('admin.tiket.index', compact('tickets'));

    }

    public function create()
    {
        return view('admin.tiket.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        TicketType::create($data);

        return redirect()->route('admin.tiket.index')
            ->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit(TicketType $tiket)
    {
        return view('admin.tiket.edit', ['ticket' => $tiket]);
    }

    public function update(Request $request, TicketType $tiket)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $tiket->update($data);

        return redirect()->route('admin.tiket.index')
            ->with('success', 'Tiket berhasil diupdate.');
    }

    public function destroy(TicketType $tiket)
    {
        $tiket->delete();

        return redirect()->route('admin.tiket.index')
            ->with('success', 'Tiket berhasil dihapus.');
    }
}
