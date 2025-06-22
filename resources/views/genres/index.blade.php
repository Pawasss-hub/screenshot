@extends('layouts.admin') {{-- Sesuaikan dengan layout admin kamu --}}

@section('title', 'Genre List')

@section('content')
<main class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Genres</h1>
        <a href="{{ route('genres.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Add New Genre</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 w-16">No</th>
                <th class="border border-gray-300 px-4 py-2">Genre Name</th>
                <th class="border border-gray-300 px-4 py-2 w-40">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($genres as $index => $genre)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $genres->firstItem() + $index }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $genre->name }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                        <a href="{{ route('genres.edit', $genre->id) }}"
                           class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin hapus genre ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">No genres found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $genres->links() }}
    </div>

</main>
@endsection
