<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Pemesanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($bookings->count() === 0)
                        <div class="text-gray-500">Belum ada pemesanan.</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2">Kode</th>
                                        <th class="py-2">Tanggal Kunjungan</th>
                                        <th class="py-2">Total</th>
                                        <th class="py-2">Status</th>
                                        <th class="py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $b)
                                        <tr class="border-b border-gray-100 dark:border-gray-700">
                                            <td class="py-2">{{ $b->code }}</td>
                                            <td class="py-2">{{ optional($b->visit_date)->format('d-m-Y') }}</td>
                                            <td class="py-2">Rp {{ number_format($b->total,0,',','.') }}</td>
                                            <td class="py-2">{{ $b->status }}</td>
                                            <td class="py-2">
                                                <a class="underline text-indigo-500"
                                                   href="{{ route('user.bookings.show', $b->id) }}">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $bookings->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
