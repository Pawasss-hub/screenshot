<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-[#020100] text-white p-5 space-y-6">
        <h1 class="text-2xl font-bold mb-10">🎬 Admin</h1>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('films.index') }}" class="hover:text-[#BC6C25]">🎞️ Films</a>
            <a href="{{ route('scenes.index') }}" class="hover:text-[#BC6C25]">🎬 Scenes</a>
            <a href="{{ route('tags.index') }}" class="hover:text-[#BC6C25]">🏷️ Tags</a>
            <a href="{{ route('genres.index')}}" class="hover:text-[#BC6C25]">🎭 Genres</a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold">ShotCafe Admin</div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-[#BC6C25] font-medium">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
@section('content')
