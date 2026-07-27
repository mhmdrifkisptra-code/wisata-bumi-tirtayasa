<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()
            ->with(['user'])
            ->paginate(10);

        $total = Booking::count();
        $hariIni = Booking::whereDate('created_at', today())->count();

        return view('admin.pemesanan.index', compact('bookings', 'total', 'hariIni'));
    }

    public function show(Booking $booking)
    {
        $booking->load([
            'user',
            'items.ticketType', // pastikan relasi ini ada (lihat catatan di bawah)
        ]);

        return view('admin.pemesanan.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,paid,cancelled,confirmed'],
        ]);

        $booking->update([
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Status pemesanan berhasil diupdate.');
    }
}
