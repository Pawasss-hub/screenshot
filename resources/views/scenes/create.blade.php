<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Scene - Admin Dashboard</title>
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
                    <i class="fas fa-video text-white text-xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-text">Create New Scene</h1>
            </div>
            <p class="text-text/70">Add a new scene to the collection</p>
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

            <form action="{{ route('scenes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-info-circle text-accent mr-2"></i>
                        Scene Information
                    </h3>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-text mb-3">Scene Title</label>
                        <div class="relative">
                            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                                   class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                                   placeholder="Enter scene title...">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-video text-text/30"></i>
                            </div>
                        </div>
                    </div>

                <div>
                        <label for="film_id" class="block text-sm font-medium text-text mb-3">Film</label>
                        <select id="film_id" name="film_id" 
                                class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200">
                            <option value="">Select a film...</option>
                            @foreach($films as $film)
                            <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                    {{ $film->title }} ({{ $film->release_year }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                        <label for="description" class="block text-sm font-medium text-text mb-3">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 resize-none"
                                  placeholder="Describe this scene...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Tags -->
                <div class="space-y-6 pt-6 border-t border-secondary/50">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-tags text-accent mr-2"></i>
                        Tags
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach($tags as $tag)
                            <label class="flex items-center p-3 bg-background rounded-lg border border-secondary/50 hover:border-primary/50 transition-all duration-200 cursor-pointer">
                                <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}"
                                       {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}
                                       class="mr-3 w-4 h-4 text-primary bg-background border-secondary/50 rounded focus:ring-primary focus:ring-2">
                                <span class="text-sm text-text">{{ $tag->name }}</span>
                    </label>
                        @endforeach
                    </div>
                </div>

                <!-- Media Upload -->
                <div class="space-y-6 pt-6 border-t border-secondary/50">
                    <h3 class="text-lg font-semibold text-text flex items-center">
                        <i class="fas fa-upload text-accent mr-2"></i>
                        Scene Image
                    </h3>
                    
                <div>
                        <label for="image" class="block text-sm font-medium text-text mb-3">Upload Scene Image</label>
                        <div class="relative">
                            <input type="file" id="image" name="image" accept="image/*" 
                                   class="w-full text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-accent hover:file:text-background transition-all duration-200 cursor-pointer">
                            </div>
                        <p class="text-text/50 text-sm mt-2">Upload a screenshot or image from the scene</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 pt-8 border-t border-secondary/50">
                    <button type="submit" class="flex-1 bg-primary hover:bg-accent hover:text-background text-white py-3 px-6 rounded-lg transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Create Scene
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
    // Auto focus and form enhancement
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('title').focus();

        // Enhanced select styling
        const filmSelect = document.getElementById('film_id');
        filmSelect.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('text-text');
            } else {
                this.classList.add('text-text/50');
                    }
                });
        });
    </script>

</body>
</html>
