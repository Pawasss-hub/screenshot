<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-background text-text">

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-accent hover:text-primary mb-4">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>
            <h1 class="text-2xl font-bold text-text">Edit User</h1>
        </div>

        <!-- Form -->
        <div class="bg-secondary p-6 rounded-lg border border-secondary/50">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-text mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full px-3 py-2 bg-background border border-secondary/50 rounded-lg text-text focus:outline-none focus:border-primary">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-text mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full px-3 py-2 bg-background border border-secondary/50 rounded-lg text-text focus:outline-none focus:border-primary">
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-text mb-2">Role</label>
                        <select id="role" name="role" 
                                class="w-full px-3 py-2 bg-background border border-secondary/50 rounded-lg text-text focus:outline-none focus:border-primary">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="flex-1 bg-primary hover:bg-accent hover:text-background text-white py-2 px-4 rounded-lg transition-colors">
                            Update User
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex-1 bg-background text-text py-2 px-4 rounded-lg border border-secondary/50 hover:bg-secondary/50 transition-colors text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html> 