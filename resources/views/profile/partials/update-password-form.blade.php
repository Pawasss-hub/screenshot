<section class="bg-secondary rounded-lg p-6 border border-gray-700">
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-white mb-2">
            Update Password
        </h2>
        <p class="text-gray-400 text-sm">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                Current Password
            </label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                autocomplete="current-password"
            />
            @error('current_password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                New Password
            </label>
            <input
                id="password"
                name="password"
                type="password"
                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                autocomplete="new-password"
            />
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                Confirm Password
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                autocomplete="new-password"
            />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Update Button -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-primary hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-400">Password updated successfully!</p>
            @endif
        </div>
    </form>
</section>
