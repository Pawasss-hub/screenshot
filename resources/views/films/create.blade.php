<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Film - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-background text-text min-h-screen">

<div class="min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-accent hover:text-primary mb-4 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>
            <div class="flex items-center justify-center space-x-3 mb-2">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                    <i class="fas fa-film text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-text">Create New Film</h1>
            </div>
            <p class="text-text/70">Add a new film to the collection</p>
        </div>

        <!-- Form -->
        <div class="bg-secondary p-8 rounded-xl border border-secondary/50 shadow-lg">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-2"></i>
                        <span class="font-medium text-red-400">Please fix the following errors:</span>
                    </div>
                    <ul class="text-red-300 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-info-circle text-accent mr-2"></i>
                        Basic Information
                    </h3>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-text mb-3">Film Title</label>
                        <div class="relative">
                            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="e.g. Interstellar">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-film text-text/30"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="release_year" class="block text-sm font-medium text-text mb-3">Release Year</label>
                            <input type="number" id="release_year" name="release_year" value="{{ old('release_year') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="e.g. 2024" min="1900" max="2030">
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-text mb-3">Duration (minutes)</label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="e.g. 120" min="1" max="999">
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-text mb-3">Language</label>
                            <input type="text" id="language" name="language" value="{{ old('language') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="e.g. English">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="director" class="block text-sm font-medium text-text mb-3">Director</label>
                            <input type="text" id="director" name="director" value="{{ old('director') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="Director name">
                        </div>

                        <div>
                            <label for="cast" class="block text-sm font-medium text-text mb-3">Cast</label>
                            <input type="text" id="cast" name="cast" value="{{ old('cast') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="Cast names (comma separated)">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-text mb-3">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 resize-none"
                                  placeholder="Write film synopsis here...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Visual Settings -->
                <div class="space-y-6 pt-6 border-t border-secondary/50">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-palette text-accent mr-2"></i>
                        Visual Settings
                    </h3>
                    
                    <div>
                        <label for="overlay_color" class="block text-sm font-medium text-text mb-3">Overlay Color</label>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="color" id="overlay_color" name="overlay_color" value="{{ old('overlay_color', '#000000') }}" 
                                       class="w-16 h-12 bg-background border border-secondary/50 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                       style="appearance: none; -webkit-appearance: none;">
                                <div class="absolute inset-0 rounded-lg overflow-hidden pointer-events-none">
                                    <div class="w-full h-full" id="color-preview"></div>
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="text" id="color-hex" 
                                       class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                       placeholder="#000000" readonly>
                                <p class="text-text/50 text-sm mt-1">Color for text overlay on film images</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Genres -->
                <div class="space-y-6 pt-6 border-t border-secondary/50">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-theater-masks text-accent mr-2"></i>
                        Genres
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($genres as $genre)
                            <label class="flex items-center p-3 bg-background rounded-lg border border-secondary/50 hover:border-primary/50 transition-all duration-200 cursor-pointer">
                                <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                                       {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}
                                       class="mr-3 w-4 h-4 text-primary bg-background border-secondary/50 rounded focus:ring-primary focus:ring-2">
                                <span class="text-sm text-text">{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- File Uploads -->
                <div class="space-y-6 pt-6 border-t border-secondary/50">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-upload text-accent mr-2"></i>
                        Media Files
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="logo" class="block text-sm font-medium text-text mb-3">Logo</label>
                            <div class="relative">
                                <input type="file" id="logo" name="logo" accept="image/*" 
                                       class="w-full text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-accent hover:file:text-background transition-all duration-200 cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label for="poster" class="block text-sm font-medium text-text mb-3">Poster</label>
                            <div class="relative">
                                <input type="file" id="poster" name="poster" accept="image/*" 
                                       class="w-full text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-accent hover:file:text-background transition-all duration-200 cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label for="background" class="block text-sm font-medium text-text mb-3">Background</label>
                            <div class="relative">
                                <input type="file" id="background" name="background" accept="image/*" 
                                       class="w-full text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-accent hover:file:text-background transition-all duration-200 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 pt-8 border-t border-secondary/50">
                    <button type="submit" class="flex-1 bg-primary hover:bg-accent hover:text-background text-white py-3 px-6 rounded-lg transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Create Film
                    </button>
                    <button type="reset" class="px-6 py-3 bg-background text-text rounded-lg border border-secondary/50 hover:bg-secondary/50 transition-all duration-200 font-medium">
                        Reset
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-background text-text rounded-lg border border-secondary/50 hover:bg-secondary/50 transition-all duration-200 text-center font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Color picker functionality
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('overlay_color');
        const colorHex = document.getElementById('color-hex');
        const colorPreview = document.getElementById('color-preview');
        
        function updateColorDisplay() {
            const color = colorInput.value;
            colorHex.value = color.toUpperCase();
            colorPreview.style.backgroundColor = color;
        }
        
        colorInput.addEventListener('input', updateColorDisplay);
        colorInput.addEventListener('change', updateColorDisplay);
        
        // Initialize color display
        updateColorDisplay();
        
        // Auto focus on title
        document.getElementById('title').focus();
    });
</script>

</body>
</html>
