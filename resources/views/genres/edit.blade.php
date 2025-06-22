@extends('layouts.app')

@section('content')
<h1>Edit Genre</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('genres.update', $genre->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Nama Genre</label>
    <input type="text" name="name" id="name" value="{{ old('name', $genre->name) }}" required>
    <button type="submit">Update</button>
</form>

<a href="{{ route('genres.index') }}">Kembali ke daftar</a>
@endsection
