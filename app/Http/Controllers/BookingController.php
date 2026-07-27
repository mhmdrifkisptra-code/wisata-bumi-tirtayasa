<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\TicketType;
use App\Models\Booking;
use App\Models\BookingItem;

class BookingController extends Controller
{
    // FORM PESAN TIKET
    public function create()
    {
        $tickets = TicketType::where('is_active', true)
            ->orderBy('id')
            ->get();

        return view('pages.booking_create', compact('tickets'));
    }

    // SIMPAN PESANAN + HITUNG TOTAL
    public function store(Request $request)
    {
        $request->validate([
            'visit_date' => ['required', 'date'],
            'tickets'    => ['required', 'array'],
        ]);

        $ticketIds = array_keys($request->tickets ?? []);
        $ticketTypes = TicketType::whereIn('id', $ticketIds)->get()->keyBy('id');

        $items = [];
        $total = 0;

        foreach (($request->tickets ?? []) as $ticketTypeId => $qty) {
            $qty = (int) $qty;
            if ($qty <= 0) continue;

            if (!isset($ticketTypes[$ticketTypeId])) continue;

            $price = (int) $ticketTypes[$ticketTypeId]->price;
            $subtotal = $price * $qty;

            $items[] = [
                'ticket_type_id' => (int) $ticketTypeId,
                'qty' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        if ($total <= 0 || count($items) === 0) {
            return back()
                ->withErrors(['tickets' => 'Pilih minimal 1 tiket.'])
                ->withInput();
        }

        $code = 'BMT-' . strtoupper(Str::random(8));

        $booking = Booking::create([
            'user_id' => 1, // sementara
            'visit_date' => $request->visit_date,
            'code' => $code,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $it) {
            BookingItem::create([
                'booking_id' => $booking->id,
                'ticket_type_id' => $it['ticket_type_id'],
                'qty' => $it['qty'],
                'price' => $it['price'],
                'subtotal' => $it['subtotal'],
            ]);
        }

        return redirect()->route('booking.pay', ['code' => $booking->code]);
    }

    // HALAMAN BAYAR (SNAP MIDTRANS)
    public function pay($code)
    {
        $booking = Booking::where('code', $code)->firstOrFail();
        $items = BookingItem::with('ticketType')
            ->where('booking_id', $booking->id)
            ->get();

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = (bool) config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $itemDetails = [];
        foreach ($items as $it) {
            $itemDetails[] = [
                'id' => (string) $it->ticket_type_id,
                'price' => (int) $it->price,
                'quantity' => (int) $it->qty,
                'name' => $it->ticketType ? $it->ticketType->name : 'Tiket',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $booking->code,
                'gross_amount' => (int) $booking->total,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => 'Guest',
                'email' => 'guest@example.com',
            ],
        ];

        if (!$booking->snap_token) {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $booking->update(['snap_token' => $snapToken]);
            $booking->refresh();
        }

        return view('pages.booking_pay', [
            'booking' => $booking,
            'snapToken' => $booking->snap_token,
            'clientKey' => config('services.midtrans.client_key'),
            'isProduction' => (bool) config('services.midtrans.is_production'),
        ]);
    }
}
