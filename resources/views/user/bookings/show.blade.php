<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Pemesanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a class="underline text-indigo-500" href="{{ route('user.bookings.index') }}">
                    ← Kembali ke Riwayat
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div><b>Kode:</b> {{ $booking->code }}</div>
                    <div><b>Tanggal Kunjungan:</b> {{ optional($booking->visit_date)->format('d-m-Y') }}</div>
                    <div><b>Total:</b> Rp {{ number_format($booking->total,0,',','.') }}</div>
                    <div><b>Status:</b> {{ $booking->status }}</div>
                    <div><b>Payment Status:</b> {{ $booking->payment_status }}</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold mb-3">Riwayat Status</h3>

                    @if($booking->statusHistories->count() === 0)
                        <div class="text-gray-500">Belum ada riwayat.</div>
                    @else
                        <ul class="list-disc pl-5 space-y-2">
                            @foreach($booking->statusHistories as $h)
                                <li>
                                    {{ optional($h->changed_at)->format('d-m-Y H:i') }}
                                    — {{ $h->from_status ?? '-' }} → <b>{{ $h->to_status }}</b>
                                    @if($h->note) ({{ $h->note }}) @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
