<section class="bg-gray-800 rounded-lg p-6 border border-red-600">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-white mb-2">
            Delete Account
        </h2>
        <p class="text-gray-400 text-sm">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <!-- Password Confirmation -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                Password
            </label>
            <input
                id="password"
                name="password"
                type="password"
                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"
                placeholder="Enter your password to confirm"
            />
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Delete Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                Delete Account
            </button>
        </div>
    </form>
</section>
