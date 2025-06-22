<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ScreenSpot - Sign Up</title>

    @vite('resources/css/app.css')

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="relative bg-cover bg-center min-h-screen text-text" style="background-image: url('{{ asset('images/loginimg.png') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>

    <div class="relative z-10 flex min-h-screen">
      <!-- Left Side - Sign Up Form -->
      <div class="flex-1 flex flex-col justify-center px-8 lg:px-16 xl:px-24 max-w-md lg:max-w-lg xl:max-w-xl">

        <!-- Logo -->
        <div class="mb-16">
          <div class="flex items-center">
            <img src="{{ asset('images/sslogo.png') }}" alt="ScreenSpot Logo" class="h-10 sm:h-12 md:h-16 w-auto">
          </div>
        </div>

        <!-- Welcome Text -->
        <div class="mb-8">
          <h1 class="text-4xl lg:text-5xl font-heading font-semibold text-white mb-2">
            Create Account
          </h1>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf

          <!-- Name (Username) -->
          <div>
            <input
              type="text"
              name="name"
              value="{{ old('name') }}"
              required
              autofocus
              placeholder="your username..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
            @error('name')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email -->
          <div>
            <input
              type="email"
              name="email"
              value="{{ old('email') }}"
              required
              placeholder="your email..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
            @error('email')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password -->
          <div>
            <input
              type="password"
              name="password"
              required
              placeholder="your password..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
            @error('password')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div>
            <input
              type="password"
              name="password_confirmation"
              required
              placeholder="confirm password..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
          </div>

          <!-- Submit -->
          <div>
            <button
              type="submit"
              class="w-full bg-primary hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-md transition-colors duration-200 uppercase tracking-wide"
            >
              SIGN UP
            </button>
          </div>
        </form>

        <!-- Already Have Account -->
        <div class="mt-8 text-center">
          <p class="text-sm text-gray-400">
            already have an account?
            <a href="{{ route('login') }}" class="text-primary hover:text-accent font-medium transition-colors duration-200 ml-1">
              log in
            </a>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
