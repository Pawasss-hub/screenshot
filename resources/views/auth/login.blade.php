<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ScreenSpot - Welcome Back</title>

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
      <!-- Left Side - Login Form -->
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
            welcome back
          </h1>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
          @csrf

          <!-- Email Input -->
          <div>
            <input
              type="email"
              name="email"
              value="{{ old('email') }}"
              required
              autofocus
              autocomplete="username"
              placeholder="your email..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
            @error('email')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password Input -->
          <div>
            <input
              type="password"
              name="password"
              required
              autocomplete="current-password"
              placeholder="your password..."
              class="w-full px-4 py-3 bg-gray-700 bg-opacity-50 border border-gray-600 rounded-md text-text placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
            />
            @error('password')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Remember Me -->
          <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="mr-2 text-primary focus:ring-primary border-gray-600 rounded" name="remember">
            <label for="remember_me" class="text-sm text-gray-300">Remember me</label>
          </div>

          <!-- Submit Button -->
          <div>
            <button
              type="submit"
              class="w-full bg-primary hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-md transition-colors duration-200 uppercase tracking-wide"
            >
              SUBMIT
            </button>
          </div>
        </form>

        <!-- Forgot Password & Sign Up Links -->
        <div class="mt-8 space-y-4 text-center">
          @if (Route::has('password.request'))
            <div>
              <a href="{{ route('password.request') }}" class="text-gray-400 hover:text-accent text-sm transition-colors duration-200">
                forgot your password?
              </a>
            </div>
          @endif
          <div>
            <a href="{{ route('register') }}" class="text-primary hover:text-accent font-medium transition-colors duration-200">
              sign up for free
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
