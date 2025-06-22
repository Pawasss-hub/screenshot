<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - ScreenSpot</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'text': '#e8e8e8',
                        'background': '#0d0d0d',
                        'primary': '#4F51CD',
                        'secondary': '#1e1e1e',
                        'accent': '#00d4aa',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Oswald', 'Impact', 'sans-serif'],
                        'heading': ['Poppins', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .aspect-\[2\/3\] {
            aspect-ratio: 2 / 3;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-background min-h-screen">
    <!-- Navbar -->
    <nav class="bg-background shadow-lg sticky top-0 z-50 border-b border-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('homepage.public') }}">
                            <img src="{{ asset('images/sslogo.png') }}" alt="ScreenSpot Logo" class="h-6 sm:h-8 md:h-10 w-auto">
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('homepage.public') }}" class="text-text hover:text-accent transition duration-200 font-medium">
                        Home
                    </a>
                    <a href="{{ route('films.index') }}" class="text-accent font-medium">
                        Movies
                    </a>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center space-x-4">
                    @if($user)
                        <div class="flex items-center space-x-3">
                            <span class="text-text font-bold font-sans">Hello, {{ $user->name }}</span>
                            <div class="relative">
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-text hover:text-accent transition duration-200">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-accent hover:text-primary font-medium">Login</a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Register</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-b from-secondary to-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-heading font-bold text-white mb-4">
                    Movie Collection
                </h1>
                <p class="text-xl text-text/70 mb-8 max-w-2xl mx-auto">
                    Discover our curated collection of amazing films from various genres and years
                </p>
                <div class="flex items-center justify-center space-x-4 text-text/60">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-film"></i>
                        <span>{{ $films->count() }} Movies</span>
                    </div>
                    <div class="w-1 h-1 bg-text/40 rounded-full"></div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar"></i>
                        <span>Updated regularly</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Movies Grid Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid Container -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                @forelse($films as $film)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <!-- Movie Poster -->
                        <a href="{{ route('films.show', $film->id) }}" class="block">
                            <div class="relative aspect-[2/3] overflow-hidden">
                                @if($film->poster)
                                    <img 
                                        src="{{ asset('storage/' . $film->poster) }}" 
                                        alt="{{ $film->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-accent to-primary flex items-center justify-center">
                                        <i class="fas fa-film text-white text-3xl"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay with Title -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <h3 class="text-white font-semibold text-sm leading-tight line-clamp-2">
                                            {{ $film->title }}
                                        </h3>
                                        @if($film->release_year)
                                            <p class="text-white/70 text-xs mt-1">
                                                {{ $film->release_year }}
                                                @if($film->duration)
                                                    • {{ $film->duration }} min
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Play Icon on Hover -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                                        <i class="fas fa-play text-white text-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-film text-text/40 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-text mb-2">No Movies Available</h3>
                            <p class="text-text/60 mb-6">We're working on adding more amazing films to our collection.</p>
                            <a href="{{ route('homepage.public') }}" class="inline-flex items-center space-x-2 bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                                <i class="fas fa-home"></i>
                                <span>Back to Home</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Load More Button (if needed) -->
            @if($films->count() > 0)
                <div class="text-center mt-12">
                    <p class="text-text/60 text-sm">
                        Showing {{ $films->count() }} movies
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary border-t border-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; 2024 ScreenSpot. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation for images
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.add('loaded');
                });
            });
        });
    </script>
</body>
</html> 