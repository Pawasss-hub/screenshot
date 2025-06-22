  <div class="w-full max-w-4xl flex flex-col lg:flex-row bg-white dark:bg-[#161615] rounded-lg overflow-hidden border">
    <!-- Left Form Section -->
    <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col">
      <h2 class="text-2xl font-semibold mb-6 text-center font-['Inter'] text-[#BC6C25]">Log In</h2>
      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
          <label for="email" class="block mb-1 text-sm">Email</label>
          <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="you@example.com"
            required
            autofocus
            class="w-full px-4 py-2 border rounded-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white @error('email') border-red-500 @enderror"
          />
          @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="block mb-1 text-sm">Password</label>
          <input
            id="password"
            type="password"
            name="password"
            placeholder="••••••••"
            required
            class="w-full px-4 py-2 border rounded-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white @error('password') border-red-500 @enderror"
          />
          @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <button
          type="submit"
          class="w-full py-2 bg-[#1b1b18] text-white rounded-sm hover:bg-[#333]"
        >
          Log In
        </button>

        <div class="text-center">
          <p class="text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#020100] font-semibold">Sign Up</a>
          </p>
        </div>
      </form>
    </div>

    <!-- Right Image Section -->
    <div class="w-full lg:w-1/2 bg-[#fff2f2] dark:bg-[#1D0002]">
      <div class="w-full h-full flex items-center justify-center">
        <img
          src="/images/20th_post6.png"
          alt="Login illustration"
          class="w-full h-full object-cover rounded-tr-lg rounder-br-lg"
        />
      </div>
    </div>
  </div>
