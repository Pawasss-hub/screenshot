@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">🎞️ Films</h2>
        <a href="{{ route('films.create') }}" class="bg-[#BC6C25] hover:bg-[#a15b1d] text-white px-4 py-2 rounded">+ Tambah Film</a>
    </div>

    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="px-4 py-2 text-left">Poster</th>
                <th class="px-4 py-2 text-left">Judul</th>
                <th class="px-4 py-2 text-left">Tahun</th>
                <th class="px-4 py-2 text-left">Durasi</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="h-16 rounded">
                    </td>
                    <td class="px-4 py-2">{{ $film->title }}</td>
                    <td class="px-4 py-2">{{ $film->release_year }}</td>
                    <td class="px-4 py-2">{{ $film->duration }} min</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('films.edit', $film->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <button onclick="openModal({{ $film->id }})" class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>

                {{-- Modal Konfirmasi --}}
                <div id="modal-{{ $film->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-6 rounded shadow max-w-sm">
                        <h3 class="text-lg font-semibold mb-4">Hapus Film?</h3>
                        <p class="mb-4">Apakah kamu yakin ingin menghapus <strong>{{ $film->title }}</strong>?</p>
                        <div class="flex justify-end space-x-2">
                            <button onclick="closeModal({{ $film->id }})" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).classList.add('hidden');
        }
    </script>
@endsection
