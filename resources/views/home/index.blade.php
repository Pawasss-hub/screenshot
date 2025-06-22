<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <title>Home Page</title>
  </head>
  <body class="font-['Montserrat']">
    <section class="relative h-screen w-full text-white">
      <img
        src="/images/HOMEBG.png"
        alt="Hero Background"
        class="absolute inset-0 w-full h-full object-cover"
      />
      <div
        class="absolute inset-0 bg-gradient-to-b from-[#020100]/20 via-[#020100]/50 to-[#020100]/100 z-10"
      ></div>
      <div
        class="relative z-10 flex ml-[600px] pt-72 flex-col h-full px-4 text-center max-w-3xl mx-auto"
      >
        <h1 class="text-5xl font-extrabold mb-6 leading-tight">
          Discover & Relive Iconic Movie Scenes
        </h1>
        <p class="text-xl mb-8">
          Explore your favorite movie moments, download scenes, and create your
          own playlists.
        </p>
        <form action="{{ route('login') }}" method="GET">
          <button
            type="submit"
            class="bg-[#BC6C25] hover:bg-[#a75f20] text-white hover:text-[#020100] px-8 py-3 rounded-xl text-lg font-semibold shadow-md transition duration-300 ease-in-out cursor-pointer"

          >
            Get Started
          </button>
        </form>
      </div>
    </section>

    <section class="bg-[#020100] py-16 font-['Montserrat']">
      <div class="container mx-auto px-14">
        <hr class="h-px my-8 bg-[#BC6C25] border-0 dark:bg-gray-700" />
        <div class="flex justify-between items-center mb-5">
          <h3 class="text-white text-lg font-semibold">
            Featured Movies
          </h3>
          <a href="{{ route('films.index') }}" class="text-[#BC6C25] hover:text-[#a75f20] font-medium transition duration-200">
            View All Movies →
          </a>
        </div>
        <div class="grid grid-cols-4 grid-rows-2 gap-4">
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/EEA.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/20th-poster.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/Chunking.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/InTheMood.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/PastLives.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/Her.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/Eternal.jpg"
              alt=""
            />
          </div>
          <div>
            <img
              class="h-auto w-full rounded-lg"
              src="/images/MeloMovie-Poster.jpg"
              alt=""
            />
          </div>
        </div>
      </div>
    </section>

    <section class="bg-[#020100] py-16">
      <!-- component -->
      <div class="container mx-auto px-14">
        <hr class="h-px mb-5 bg-[#BC6C25] border-0 dark:bg-gray-700" />
        <h3 class="text-white text-center text-lg font-semibold mb-3">
          Featured Scenes
        </h3>
        <div class="grid grid-cols-3 gap-4">
          <img src="/images/20th_post7.png" class="w-full rounded" />
          <img src="/images/20th_post6.png" class="w-full rounded" />
          <img src="/images/20th_post5.png" class="w-full rounded" />
          <img src="/images/20th_post4.png" class="w-full rounded" />
          <img src="/images/20th_post3.png" class="w-full rounded" />
          <img src="/images/20th_post2.png" class="w-full rounded" />
          <img src="/images/20th_post1.png" class="w-full rounded" />
          <img src="/images/20th_post8.png" class="w-full rounded" />
          <img src="/images/20th_post9.png" class="w-full rounded" />
          <img src="/images/20th_post10.png" class="w-full rounded" />
          <img src="/images/20th_post11.png" class="w-full rounded" />
          <img src="/images/20th_post12.png" class="w-full rounded" />
          <img src="/images/20th_post13.png" class="w-full rounded" />
          <img src="/images/20th_post14.png" class="w-full rounded" />
          <img src="/images/20th_post15.png" class="w-full rounded" />
        </div>
      </div>
    </section>

    <footer class="bg-black text-gray-400 py-10 text-center">
    <p>© 2025 SceneShot. All rights reserved.</p>
    </footer>
  </body>
</html>
