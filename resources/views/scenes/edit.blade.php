@extends('layouts.clean')

@section('title', 'Edit Scene')
@section('ChildContent')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Scene</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('scenes.update', $scene->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Film</label>
            <select name="film_id" class="w-full border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Pilih Film --</option>
                @foreach ($films as $film)
                    <option value="{{ $film->id }}"
                        {{ (old('film_id') ?? $scene->film_id) == $film->id ? 'selected' : '' }}>
                        {{ $film->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Judul Scene</label>
            <input type="text" name="title" value="{{ old('title', $scene->title) }}"
                   class="w-full border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi (opsional)</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded px-3 py-2">{{ old('description', $scene->description) }}</textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Gambar (biarkan kosong jika tidak ingin mengganti)</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full border border-gray-300 rounded px-3 py-2">
            @if ($scene->image)
                <img src="{{ asset('storage/' . $scene->image) }}" alt="{{ $scene->title }}" class="mt-2 w-40 rounded object-cover">
            @endif
        </div>

        <div>
            <label class="block font-medium mb-1">Tags (opsional)</label>
            <div class="flex flex-wrap gap-2">
                @php
                    $oldTags = old('tags', $scene->tags->pluck('id')->toArray());
                @endphp
                @foreach ($tags as $tag)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ in_array($tag->id, $oldTags) ? 'checked' : '' }}>
                        <span>{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('scenes.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
