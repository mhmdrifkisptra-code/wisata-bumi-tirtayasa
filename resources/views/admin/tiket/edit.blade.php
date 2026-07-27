<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">Edit Tiket</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 rounded">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.tiket.update', $ticket->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1">Nama Tiket</label>
                    <input class="w-full border rounded p-2" name="name" value="{{ old('name', $ticket->name) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Harga</label>
                    <input class="w-full border rounded p-2" name="price" type="number" min="0" value="{{ old('price', $ticket->price) }}" required>
                </div>

                <div class="mb-6">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="is_active" {{ old('is_active', $ticket->is_active) ? 'checked' : '' }}>
                        <span>Aktif</span>
                    </label>
                </div>

                <div class="flex gap-3">
                    <button class="px-4 py-2 bg-black text-white rounded" type="submit">Update</button>
                    <a class="underline" href="{{ route('admin.tiket.index') }}">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
