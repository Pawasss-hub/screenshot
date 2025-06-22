<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $collection->name }} - ScreenShot</title>
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
        <a href="{{ route('collections.index') }}" class="text-text hover:text-accent transition-colors">
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
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-text mb-2">{{ $collection->name }}</h1>
                        @if($collection->description)
                            <p class="text-text/70">{{ $collection->description }}</p>
                        @endif
                        <div class="flex items-center space-x-4 mt-4 text-sm text-text/70">
                            <span>{{ $collection->scenes->count() }} scenes</span>
                            <span>Created {{ $collection->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('collections.addSceneForm', $collection->id) }}" class="px-4 py-2 bg-primary hover:bg-accent hover:text-background text-white font-medium rounded-lg transition-colors">
                            Add Scene
                        </a>
                        <a href="{{ route('collections.edit', $collection->id) }}" class="px-4 py-2 bg-secondary hover:bg-primary hover:text-white text-text font-medium rounded-lg transition-colors">
                            Edit
                        </a>
                    </div>
                </div>

                <!-- Scenes Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($collection->scenes as $scene)
                        <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden hover:border-primary/50 transition-colors">
                            <!-- Scene Image -->
                            <div class="aspect-w-16 aspect-h-9 bg-background">
                                @if($scene->image)
                                    <img src="{{ asset('storage/' . $scene->image) }}" alt="{{ $scene->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-secondary flex items-center justify-center">
                                        <svg class="w-12 h-12 text-text/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Scene Info -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-text mb-2">{{ $scene->title }}</h3>
                                @if($scene->film)
                                    <p class="text-accent text-sm mb-2">{{ $scene->film->title }}</p>
                                @endif
                                @if($scene->description)
                                    <p class="text-text/70 text-sm mb-3">{{ Str::limit($scene->description, 80) }}</p>
                                @endif

                                <!-- Tags -->
                                @if($scene->tags && $scene->tags->count() > 0)
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach($scene->tags->take(3) as $tag)
                                            <span class="bg-background text-text/70 px-2 py-1 rounded text-xs">{{ $tag->name }}</span>
                                        @endforeach
                                        @if($scene->tags->count() > 3)
                                            <span class="bg-background text-text/50 px-2 py-1 rounded text-xs">+{{ $scene->tags->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Remove Button -->
                                <form action="{{ route('collections.removeScene', $collection->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="scene_id" value="{{ $scene->id }}">
                                    <button type="submit" class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded transition-colors" onclick="return confirm('Remove this scene from collection?')">
                                        Remove from Collection
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="col-span-full text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-6 bg-secondary rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-text/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-text mb-2">No Scenes Yet</h3>
                            <p class="text-text/70 mb-6">Start adding scenes to your collection</p>
                            <a href="{{ route('collections.addSceneForm', $collection->id) }}" class="inline-flex items-center px-6 py-3 bg-primary hover:bg-accent hover:text-background text-white font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add First Scene
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>
