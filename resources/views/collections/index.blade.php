<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections - ScreenShot</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background text-text min-h-screen">
    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b border-secondary">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-primary rounded flex items-center justify-center">
                <span class="text-white font-bold text-sm">S</span>
            </div>
            <h1 class="text-xl font-semibold text-text">ScreenShot</h1>
        </div>
        <a href="{{ route('homepage') }}" class="text-text hover:text-accent transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </a>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-secondary min-h-screen p-4">
            <nav class="space-y-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white text-text transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Account Settings</span>
                </a>
                <div class="flex items-center space-x-3 p-3 rounded-lg bg-primary text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span>Collection</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-accent hover:text-background text-text transition-colors w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-6xl">
                <!-- Header Section -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-text mb-2">My Collections</h1>
                        <p class="text-text/70">Manage your favorite movie scenes</p>
                    </div>
                    <a href="{{ route('collections.create') }}" class="px-6 py-3 bg-primary hover:bg-accent hover:text-background text-white font-medium rounded-lg transition-colors flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Create Collection</span>
                    </a>
                </div>

                <!-- Collections Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($collections as $collection)
                        <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden hover:border-primary/50 transition-colors">
                            <!-- Collection Header -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-semibold text-text">{{ $collection->name }}</h3>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('collections.edit', $collection->id) }}" class="text-text/70 hover:text-accent transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('collections.destroy', $collection->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this collection?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-text/70 hover:text-red-400 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                @if($collection->description)
                                    <p class="text-text/70 text-sm mb-4">{{ Str::limit($collection->description, 100) }}</p>
                                @endif

                                <!-- Scene Count -->
                                <div class="flex items-center space-x-2 text-text/70 text-sm mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $collection->scenes->count() }} scenes</span>
                                </div>

                                <!-- Preview Scenes -->
                                <div class="flex space-x-2 mb-4">
                                    @forelse($collection->scenes->take(3) as $scene)
                                        <div class="w-12 h-12 rounded overflow-hidden bg-background">
                                            @if($scene->image)
                                                <img src="{{ asset('storage/' . $scene->image) }}" alt="{{ $scene->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-secondary flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-text/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-text/50 text-sm">No scenes yet</div>
                                    @endforelse
                                    @if($collection->scenes->count() > 3)
                                        <div class="w-12 h-12 rounded bg-secondary flex items-center justify-center">
                                            <span class="text-text/50 text-xs">+{{ $collection->scenes->count() - 3 }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('collections.show', $collection->id) }}" class="flex-1 px-4 py-2 bg-primary hover:bg-accent hover:text-background text-white text-sm font-medium rounded transition-colors text-center">
                                        View Collection
                                    </a>
                                    <a href="{{ route('collections.addSceneForm', $collection->id) }}" class="px-4 py-2 bg-secondary hover:bg-primary hover:text-white text-text text-sm font-medium rounded transition-colors">
                                        Add Scene
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="col-span-full text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-6 bg-secondary rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-text/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-text mb-2">No Collections Yet</h3>
                            <p class="text-text/70 mb-6">Start creating collections to organize your favorite movie scenes</p>
                            <a href="{{ route('collections.create') }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-accent hover:text-background text-white font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create Your First Collection
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>
