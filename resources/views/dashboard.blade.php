<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ScreenShot</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-background text-text">

<div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-secondary text-text p-5 space-y-6 border-r border-secondary/50">
        <div class="flex items-center space-x-2 mb-8">
            <img src="{{ asset('images/sslogo.png') }}" alt="ScreenShot Logo" class="h-8 w-auto">
            <h1 class="text-xl font-bold text-text">Admin Panel</h1>
        </div>
        
        <nav class="flex flex-col space-y-2">
            <a href="#dashboard" onclick="showSection('dashboard')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="dashboard">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="#users" onclick="showSection('users')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="users">
                <i class="fas fa-users w-5"></i>
                <span>Users</span>
            </a>
            <a href="#films" onclick="showSection('films')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="films">
                <i class="fas fa-film w-5"></i>
                <span>Films</span>
            </a>
            <a href="#scenes" onclick="showSection('scenes')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="scenes">
                <i class="fas fa-video w-5"></i>
                <span>Scenes</span>
            </a>
            <a href="#tags" onclick="showSection('tags')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="tags">
                <i class="fas fa-tags w-5"></i>
                <span>Tags</span>
            </a>
            <a href="#genres" onclick="showSection('genres')" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-primary hover:text-white transition-colors" data-section="genres">
                <i class="fas fa-theater-masks w-5"></i>
                <span>Genres</span>
            </a>
        </nav>

        <div class="pt-6 border-t border-secondary/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-accent hover:text-background text-text transition-colors">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        {{-- Header --}}
        <header class="bg-secondary border-b border-secondary/50 px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-text" id="page-title">Dashboard</div>
            <div class="flex items-center space-x-4">
                <span class="text-text/70">Welcome, {{ auth()->user()->name }}</span>
                <a href="{{ route('homepage') }}" class="text-accent hover:text-primary transition-colors">
                    <i class="fas fa-home"></i>
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6 overflow-auto">
            <!-- Dashboard Overview Section -->
            <div id="dashboard-section" class="section-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-text/70 text-sm">Total Users</p>
                                <p class="text-2xl font-bold text-text">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-text/70 text-sm">Total Films</p>
                                <p class="text-2xl font-bold text-text">{{ \App\Models\Film::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-film text-white"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-text/70 text-sm">Total Scenes</p>
                                <p class="text-2xl font-bold text-text">{{ \App\Models\Scene::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-video text-white"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-text/70 text-sm">Total Collections</p>
                                <p class="text-2xl font-bold text-text">{{ \App\Models\Collection::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-folder text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <h3 class="text-lg font-semibold text-text mb-4">Recent Users</h3>
                        <div class="space-y-3">
                            @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                <div class="flex items-center justify-between p-3 bg-background rounded">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-text font-medium">{{ $user->name }}</p>
                                            <p class="text-text/70 text-sm">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="text-text/50 text-sm">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
                        <h3 class="text-lg font-semibold text-text mb-4">Recent Films</h3>
                        <div class="space-y-3">
                            @foreach(\App\Models\Film::latest()->take(5)->get() as $film)
                                <div class="flex items-center justify-between p-3 bg-background rounded">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="w-10 h-14 object-cover rounded">
                                        <div>
                                            <p class="text-text font-medium">{{ $film->title }}</p>
                                            <p class="text-text/70 text-sm">{{ $film->release_year }}</p>
                                        </div>
                                    </div>
                                    <span class="text-text/50 text-sm">{{ $film->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text">👥 Users Management</h2>
                    <div class="text-text/70">Manage user accounts and permissions</div>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-3 text-left text-text font-medium">Name</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Email</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Role</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Joined</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary/50">
                            @foreach(\App\Models\User::all() as $user)
                                <tr class="hover:bg-background/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                            <span class="text-text">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-text">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-primary text-white text-xs rounded-full">{{ $user->role ?? 'user' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-text/70">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-accent hover:text-primary">Edit</a>
                                        <button onclick="openModal('user-{{ $user->id }}')" class="text-red-400 hover:text-red-300">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Films Section -->
            <div id="films-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text">🎞️ Films Management</h2>
                    <a href="{{ route('films.create') }}" class="bg-primary hover:bg-accent hover:text-background text-white px-4 py-2 rounded-lg transition-colors">+ Add Film</a>
                </div>

                <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-3 text-left text-text font-medium">Poster</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Title</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Year</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Duration</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary/50">
                            @foreach(\App\Models\Film::all() as $film)
                                <tr class="hover:bg-background/50">
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="h-16 w-12 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 text-text">{{ $film->title }}</td>
                                    <td class="px-6 py-4 text-text">{{ $film->release_year }}</td>
                                    <td class="px-6 py-4 text-text">{{ $film->duration }} min</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('films.edit', $film->id) }}" class="text-accent hover:text-primary">Edit</a>
                                        <button onclick="openModal('film-{{ $film->id }}')" class="text-red-400 hover:text-red-300">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Scenes Section -->
            <div id="scenes-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text">🎬 Scenes Management</h2>
                    <a href="{{ route('scenes.create') }}" class="bg-primary hover:bg-accent hover:text-background text-white px-4 py-2 rounded-lg transition-colors">+ Add Scene</a>
                </div>

                <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-3 text-left text-text font-medium">Image</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Title</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Film</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Tags</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Description</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary/50">
                            @foreach(\App\Models\Scene::with(['film', 'tags'])->get() as $scene)
                                <tr class="hover:bg-background/50">
                                    <td class="px-6 py-4">
                                        @if($scene->image)
                                            <img src="{{ asset('storage/' . $scene->image) }}" alt="{{ $scene->title }}" class="w-20 h-12 object-cover rounded">
                                        @else
                                            <div class="w-20 h-12 bg-background rounded flex items-center justify-center">
                                                <i class="fas fa-image text-text/50"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-text">{{ $scene->title }}</td>
                                    <td class="px-6 py-4 text-text">{{ $scene->film->title ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($scene->tags->take(3) as $tag)
                                                <span class="bg-background text-text/70 px-2 py-1 rounded text-xs">{{ $tag->name }}</span>
                                            @endforeach
                                            @if($scene->tags->count() > 3)
                                                <span class="bg-background text-text/50 px-2 py-1 rounded text-xs">+{{ $scene->tags->count() - 3 }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-text/70 max-w-xs truncate" title="{{ $scene->description }}">
                                        {{ Str::limit($scene->description, 50) }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('scenes.edit', $scene->id) }}" class="text-accent hover:text-primary">Edit</a>
                                        <button onclick="openModal('scene-{{ $scene->id }}')" class="text-red-400 hover:text-red-300">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tags Section -->
            <div id="tags-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text">🏷️ Tags Management</h2>
                    <a href="{{ route('tags.create') }}" class="bg-primary hover:bg-accent hover:text-background text-white px-4 py-2 rounded-lg transition-colors">+ Add Tag</a>
                </div>

                <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-3 text-left text-text font-medium">Tag Name</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Created Date</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary/50">
                            @foreach(\App\Models\Tag::all() as $tag)
                                <tr class="hover:bg-background/50">
                                    <td class="px-6 py-4 text-text">{{ $tag->name }}</td>
                                    <td class="px-6 py-4 text-text/70">{{ $tag->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('tags.edit', $tag->id) }}" class="text-accent hover:text-primary">Edit</a>
                                        <button onclick="openModal('tag-{{ $tag->id }}')" class="text-red-400 hover:text-red-300">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Genres Section -->
            <div id="genres-section" class="section-content hidden">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-text">🎭 Genres Management</h2>
                    <a href="{{ route('genres.create') }}" class="bg-primary hover:bg-accent hover:text-background text-white px-4 py-2 rounded-lg transition-colors">+ Add Genre</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-secondary rounded-lg border border-secondary/50 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-background">
                            <tr>
                                <th class="px-6 py-3 text-left text-text font-medium">No</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Genre Name</th>
                                <th class="px-6 py-3 text-left text-text font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-secondary/50">
                            @foreach(\App\Models\Genre::all() as $index => $genre)
                                <tr class="hover:bg-background/50">
                                    <td class="px-6 py-4 text-text">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-text">{{ $genre->name }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('genres.edit', $genre->id) }}" class="text-accent hover:text-primary">Edit</a>
                                        <button onclick="openModal('genre-{{ $genre->id }}')" class="text-red-400 hover:text-red-300">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Template -->
<div id="modal-template" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-secondary p-6 rounded-lg shadow-lg max-w-sm border border-secondary/50">
        <h3 class="text-lg font-semibold text-text mb-4" id="modal-title">Confirm Delete</h3>
        <p class="mb-4 text-text/70" id="modal-message">Are you sure you want to delete this item?</p>
        <div class="flex justify-end space-x-2">
            <button onclick="closeModal()" class="px-4 py-2 bg-background text-text rounded hover:bg-secondary/50 transition-colors">Cancel</button>
            <form id="delete-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Navigation functionality
    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('.section-content').forEach(section => {
            section.classList.add('hidden');
        });
        
        // Show selected section
        document.getElementById(sectionName + '-section').classList.remove('hidden');
        
        // Update active nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('bg-primary', 'text-white');
            item.classList.add('text-text');
        });
        
        event.target.closest('.nav-item').classList.add('bg-primary', 'text-white');
        event.target.closest('.nav-item').classList.remove('text-text');
        
        // Update page title
        const titles = {
            'dashboard': 'Dashboard',
            'users': 'Users Management',
            'films': 'Films Management',
            'scenes': 'Scenes Management',
            'tags': 'Tags Management',
            'genres': 'Genres Management'
        };
        document.getElementById('page-title').textContent = titles[sectionName];
    }

    // Modal functionality
    function openModal(type) {
        const modal = document.getElementById('modal-template');
        const title = document.getElementById('modal-title');
        const message = document.getElementById('modal-message');
        const form = document.getElementById('delete-form');
        
        const [itemType, id] = type.split('-');
        const itemTypes = {
            'user': { name: 'User', route: 'users.destroy' },
            'film': { name: 'Film', route: 'films.destroy' },
            'scene': { name: 'Scene', route: 'scenes.destroy' },
            'tag': { name: 'Tag', route: 'tags.destroy' },
            'genre': { name: 'Genre', route: 'genres.destroy' }
        };
        
        const item = itemTypes[itemType];
        title.textContent = `Delete ${item.name}?`;
        message.textContent = `Are you sure you want to delete this ${item.name.toLowerCase()}?`;
        
        // Set the correct route based on Laravel route names
        const routes = {
            'user': `/users/${id}`,
            'film': `/films/${id}`,
            'scene': `/scenes/${id}`,
            'tag': `/tags/${id}`,
            'genre': `/genres/${id}`
        };
        
        form.action = routes[itemType];
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal-template').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('modal-template').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Set default active section
    document.addEventListener('DOMContentLoaded', function() {
        showSection('dashboard');
    });
</script>

</body>
</html>
