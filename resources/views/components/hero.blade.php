<section class="relative h-screen w-full text-white">
    <img src="/images/herobg.JPG" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover"/>
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/50 to-black/100 z-10"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center max-w-3xl mx-auto">
        <h1 class="text-5xl font-extrabold mb-6 leading-tight">Discover & Relive Iconic Movie Scenes</h1>
        <p class="text-xl mb-8">Explore your favorite movie moments, download scenes, and create your own playlists.</p>
    <form action="{{ route('login') }}" method="GET">
        <button type="submit" class="bg-red-600 hover:bg-red-700 px-8 py-3 rounded text-lg font-semibold">
            Get Started
        </button>
    </form>
    </div>
</section>
