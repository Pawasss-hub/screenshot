@extends('layouts.admin') {{-- sesuaikan dengan layout admin kamu --}}

@section('title', 'Scene List')

@section('content')
<main class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Scenes</h1>
        <a href="{{ route('scenes.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Add New Scene</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Image</th>
                <th class="border border-gray-300 px-4 py-2">Title</th>
                <th class="border border-gray-300 px-4 py-2">Film</th>
                <th class="border border-gray-300 px-4 py-2">Tags</th>
                <th class="border border-gray-300 px-4 py-2">Description</th>
                <th class="border border-gray-300 px-4 py-2">Created At</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scenes as $scene)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($scene->image)
                            <img src="{{ asset('storage/' . $scene->image) }}" alt="{{ $scene->title }}" class="w-20 h-12 object-cover rounded" />
                        @else
                            <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $scene->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $scene->film->title ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach ($scene->tags as $tag)
                            <span class="inline-block bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded text-xs mr-1 mb-1">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-4 py-2 max-w-xs truncate" title="{{ $scene->description }}">
                        {{ Str::limit($scene->description, 50) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $scene->created_at->format('d M Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                        <a href="{{ route('scenes.edit', $scene->id) }}"
                           class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        <form action="{{ route('scenes.destroy', $scene->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure to delete this scene?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if ($scenes->isEmpty())
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">No scenes found.</td>
                </tr>
            @endif
        </tbody>
    </table>

</main>
@endsection
