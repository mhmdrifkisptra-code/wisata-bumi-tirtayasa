<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    // Halaman list riwayat pemesanan
    public function index(Request $request)
    {
        $bookings = Booking::with('items') // opsional
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('user.bookings.index', compact('bookings'));
    }

    // Detail 1 booking + history status
    public function show(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === $request->user()->id, 403);

        $booking->load(['items', 'statusHistories']);

        return view('user.bookings.show', compact('booking'));
    }
}
