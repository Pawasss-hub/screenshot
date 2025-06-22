<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Genre - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-background text-text min-h-screen">

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-accent hover:text-primary mb-4 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>
            <div class="flex items-center justify-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-theater-masks text-white"></i>
                </div>
                <h1 class="text-2xl font-bold text-text">Create New Genre</h1>
            </div>
            <p class="text-text/70">Add a new film genre</p>
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

            <form action="{{ route('genres.store') }}" method="POST" class="space-y-6">
            @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-text mb-3">Genre Name</label>
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                               class="w-full px-4 py-3 bg-background border border-secondary/50 rounded-lg text-text placeholder-text/50 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
                               placeholder="Enter genre name...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-theater-masks text-text/30"></i>
                        </div>
                    </div>
                    <p class="text-text/50 text-sm mt-2">e.g. Action, Drama, Comedy, Horror</p>
                </div>

                <div class="flex space-x-3 pt-6">
                    <button type="submit" class="flex-1 bg-primary hover:bg-accent hover:text-background text-white py-3 px-4 rounded-lg transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>
                        Create Genre
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex-1 bg-background text-text py-3 px-4 rounded-lg border border-secondary/50 hover:bg-secondary/50 transition-all duration-200 text-center font-medium">
                        Cancel
                    </a>
                </div>
            </form>
            </div>

        <!-- Tips Card -->
        <div class="mt-6 bg-primary/10 border border-primary/20 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-lightbulb text-accent mt-1 mr-3"></i>
                <div>
                    <h3 class="text-sm font-medium text-text mb-2">Popular Film Genres</h3>
                    <div class="text-sm text-text/70 space-y-1">
                        <p>• Action, Adventure, Animation</p>
                        <p>• Comedy, Crime, Documentary</p>
                        <p>• Drama, Fantasy, Horror</p>
                        <p>• Mystery, Romance, Sci-Fi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto focus and error handling
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        nameInput.focus();
        
        // Remove error styling on input
        nameInput.addEventListener('input', function() {
            this.classList.remove('border-red-500');
            const errorContainer = document.querySelector('.bg-red-500\\/10');
            if (errorContainer) {
                errorContainer.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
