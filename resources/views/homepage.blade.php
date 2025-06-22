<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ScreenSpot - Movie Database</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'text': '#e8e8e8',
                        'background': '#0d0d0d',
                        'primary': '#4F51CD',
                        'secondary': '#1e1e1e',
                        'accent': '#00d4aa',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Oswald', 'Impact', 'sans-serif'],
                        'heading': ['Poppins', 'sans-serif'],
                        'body': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-background min-h-screen">
    <!-- Navbar -->
    <nav class="bg-background shadow-lg sticky top-0 z-50 border-b border-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/sslogo.png') }}" alt="ScreenSpot Logo" class="h-6 sm:h-8 md:h-10 w-auto">
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('homepage.public') }}" class="text-accent font-medium">
                        Home
                    </a>
                    <a href="{{ route('films.index') }}" class="text-text hover:text-accent transition duration-200 font-medium">
                        Movies
                    </a>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center space-x-4">
                    @if($user)
                        <div class="flex items-center space-x-3">
                            <span class="text-text font-bold font-sans">Hello, {{ $user->name }}</span>
                            <div class="relative">
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-text hover:text-accent transition duration-200">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-accent hover:text-primary font-medium">Login</a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Register</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Search -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden" style="background-image: url('{{ asset('images/imgsearch.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        
        <!-- Search Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-heading font-bold text-white mb-6">
                Discover Movie Scenes
            </h1>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text"
                           class="block w-full pl-12 pr-4 py-4 border border-gray-600 rounded-xl leading-5 bg-secondary/80 backdrop-blur-sm placeholder-gray-400 text-text focus:outline-none focus:placeholder-gray-500 focus:ring-2 focus:ring-primary focus:border-primary text-lg"
                           placeholder="Search movies, scenes, or tags..."
                           id="searchInput"
                           autocomplete="off">
                    
                    <!-- Search Suggestions -->
                    <div id="searchSuggestions" class="hidden absolute top-full left-0 right-0 mt-2 bg-secondary/95 backdrop-blur-md border border-secondary/50 rounded-xl shadow-2xl z-50 max-h-96 overflow-y-auto">
                        <div class="p-4">
                            <!-- Loading State -->
                            <div id="searchLoading" class="hidden text-center py-8">
                                <div class="inline-flex items-center gap-2 text-text/70">
                                    <div class="animate-spin rounded-full h-4 w-4 border-2 border-primary border-t-transparent"></div>
                                    <span class="text-sm">Searching...</span>
                                </div>
                            </div>
                            
                            <!-- Content will be dynamically populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Tags Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-wrap items-center gap-3 justify-center">
            <!-- Filter by tag text -->
            <span class="text-text font-medium mr-2">Filter by tag:</span>
            
            <!-- All button (always active by default) -->
            <button class="bg-primary text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-200 font-medium filter-btn active" data-filter="all">
                All
            </button>
            
            <!-- Dynamic tags from database -->
            @forelse($tags as $tag)
                <button class="bg-secondary text-text px-6 py-2 rounded-full hover:bg-gray-700 transition duration-200 font-medium filter-btn" data-filter="{{ $tag->id }}">
                    {{ $tag->name }}
                </button>
            @empty
                <!-- Fallback tags if no tags in database -->
                <button class="bg-secondary text-text px-6 py-2 rounded-full hover:bg-gray-700 transition duration-200 font-medium filter-btn" data-filter="action">
                    Action
                </button>
                <button class="bg-secondary text-text px-6 py-2 rounded-full hover:bg-gray-700 transition duration-200 font-medium filter-btn" data-filter="drama">
                    Drama
                </button>
                <button class="bg-secondary text-text px-6 py-2 rounded-full hover:bg-gray-700 transition duration-200 font-medium filter-btn" data-filter="comedy">
                    Comedy
                </button>
                <button class="bg-secondary text-text px-6 py-2 rounded-full hover:bg-gray-700 transition duration-200 font-medium filter-btn" data-filter="thriller">
                    Thriller
                </button>
            @endforelse
        </div>
    </section>


    <!-- Scenes Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-12">
            <h2 class="text-3xl font-heading font-bold text-text mb-8 flex items-center">
                <i class="fas fa-video mr-3 text-accent"></i>Movie Scenes
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($scenes as $scene)
                    <div class="scene-item bg-secondary overflow-hidden hover:shadow-xl transition duration-300 transform hover:scale-105 group cursor-pointer" 
                         data-tags="{{ $scene->tags->pluck('id')->implode(',') }}"
                         onclick="openSceneModal({{ $scene->id }})">
                        <div class="relative overflow-hidden shadow-md h-60">
                            @if($scene->image)
                                <img src="{{ asset('storage/' . $scene->image) }}"
                                     alt="{{ $scene->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-accent to-primary flex items-center justify-center">
                                    <i class="fas fa-video text-white text-2xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-video text-gray-600 text-6xl mb-4"></i>
                        <p class="text-gray-400 text-lg">No scenes available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-secondary border-t border-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; 2024 ScreenSpot. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Search functionality with debounce
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        const searchLoading = document.getElementById('searchLoading');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.trim();
            
            // Clear previous timeout
            clearTimeout(searchTimeout);
            
            // Hide suggestions if search is empty
            if (searchTerm.length === 0) {
                searchSuggestions.classList.add('hidden');
                return;
            }
            
            // Show loading state
            searchSuggestions.classList.remove('hidden');
            searchLoading.classList.remove('hidden');
            
            // Debounce search request
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 300);
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.classList.add('hidden');
            }
        });

        // Perform search via AJAX
        function performSearch(query) {
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchLoading.classList.add('hidden');
                    updateSearchSuggestions(data);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchLoading.classList.add('hidden');
                    showNoResults(query);
                });
        }

        // Update search suggestions with results
        function updateSearchSuggestions(data) {
            const suggestionsContainer = searchSuggestions.querySelector('.p-4');
            
            if ((!data.movies || data.movies.length === 0) && (!data.tags || data.tags.length === 0)) {
                showNoResults(data.query);
                return;
            }

            let html = '';

            // Movies section
            if (data.movies && data.movies.length > 0) {
                html += `
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-text/70 mb-3 uppercase tracking-wide">Movies</h3>
                        <div class="space-y-2">
                `;
                
                data.movies.forEach(movie => {
                    html += `
                        <a href="/films/${movie.id}" 
                           class="flex items-center gap-3 p-2 rounded-lg hover:bg-primary/10 transition-colors group">
                            <div class="w-12 h-16 flex-shrink-0 rounded overflow-hidden bg-gray-700">
                                ${movie.poster ? 
                                    `<img src="/storage/${movie.poster}" alt="${movie.title}" class="w-full h-full object-cover">` :
                                    `<div class="w-full h-full bg-gray-600 flex items-center justify-center">
                                        <i class="fas fa-film text-gray-400"></i>
                                    </div>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-text font-medium truncate group-hover:text-primary transition-colors">
                                    ${movie.title}
                                </h4>
                                ${movie.release_year ? 
                                    `<p class="text-text/60 text-sm">${movie.release_year}</p>` : ''
                                }
                            </div>
                        </a>
                    `;
                });
                
                html += `
                        </div>
                    </div>
                `;
            }

            // Tags section
            if (data.tags && data.tags.length > 0) {
                html += `
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-text/70 mb-3 uppercase tracking-wide">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                `;
                
                data.tags.forEach(tag => {
                    html += `
                        <button onclick="filterByTag('${tag.name}')" 
                                class="px-3 py-1.5 bg-primary/20 text-primary rounded-full text-sm font-medium hover:bg-primary/30 transition-colors border border-primary/30">
                            #${tag.name}
                        </button>
                    `;
                });
                
                html += `
                        </div>
                    </div>
                `;
            }

            suggestionsContainer.innerHTML = html;
        }

        // Show no results message
        function showNoResults(query) {
            const suggestionsContainer = searchSuggestions.querySelector('.p-4');
            suggestionsContainer.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-text/50 mb-2">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <p class="text-text/70 text-sm">
                        No results found for '<span class="font-medium text-text">${query}</span>'
                    </p>
                </div>
            `;
        }

        // Filter by tag function
        function filterByTag(tagName) {
            // Hide search suggestions
            searchSuggestions.classList.add('hidden');
            
            // Clear search input
            searchInput.value = '';
            
            // Find and click the corresponding filter button
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => {
                if (button.textContent.trim().toLowerCase() === tagName.toLowerCase()) {
                    button.click();
                }
            });
        }

        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                // Remove active class from all buttons
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('bg-secondary', 'text-text');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-secondary', 'text-text');
                this.classList.add('bg-primary', 'text-white');
                
                console.log('Filter:', filterValue);
                
                // Filter scenes by tag
                filterScenesByTag(filterValue);
            });
        });

        // Function to filter scenes by tag
        function filterScenesByTag(tagId) {
            if (tagId === 'all') {
                // Show all scenes
                document.querySelectorAll('.scene-item').forEach(scene => {
                    scene.style.display = 'block';
                });
            } else {
                // Filter scenes by tag
                document.querySelectorAll('.scene-item').forEach(scene => {
                    const sceneTags = scene.getAttribute('data-tags');
                    if (sceneTags && sceneTags.includes(tagId)) {
                        scene.style.display = 'block';
                    } else {
                        scene.style.display = 'none';
                    }
                });
            }
        }

        // Scene modal functionality
        function openSceneModal(sceneId) {
            fetch(`/scenes/${sceneId}/modal`)
                .then((res) => res.text())
                .then((html) => {
                    // Remove old modal if exists
                    const oldModal = document.getElementById("sceneModal");
                    if (oldModal) oldModal.remove();

                    // Add new modal
                    document.body.insertAdjacentHTML("beforeend", html);

                    // Delay to ensure DOM is ready
                    setTimeout(() => {
                        const modal = document.getElementById("sceneModal");
                        const content = document.getElementById("sceneModalContent");
                        if (modal && content) {
                            modal.classList.remove("opacity-0", "pointer-events-none");
                            modal.classList.add("opacity-100");
                            content.classList.remove("opacity-0", "scale-95");
                            content.classList.add("opacity-100", "scale-100");
                        }
                        
                        // Setup comment functionality after modal is visible
                        console.log('Modal opened, setting up comment functionality...');
                        if (window.setupCommentForm) {
                            console.log('Calling setupCommentForm...');
                            window.setupCommentForm();
                        } else {
                            console.error('setupCommentForm not found in window object');
                        }
                        if (window.setupCommentElements) {
                            console.log('Calling setupCommentElements...');
                            window.setupCommentElements();
                        } else {
                            console.error('setupCommentElements not found in window object');
                        }
                    }, 100); // Increased delay to ensure DOM is fully ready
                });
        }

        function closeSceneModal() {
            const modal = document.getElementById("sceneModal");
            const content = document.getElementById("sceneModalContent");
            if (modal && content) {
                // Add exit animation
                modal.classList.remove("opacity-100");
                modal.classList.add("opacity-0", "pointer-events-none");
                content.classList.remove("opacity-100", "scale-100");
                content.classList.add("opacity-0", "scale-95");

                // Remove modal from DOM after animation
                setTimeout(() => modal.remove(), 300);
            }
        }
    </script>
    <script>
// Make functions globally available
window.setupCommentForm = function() {
    console.log('Setting up comment form...');
    const form = document.getElementById('comment-form');
    if (form) {
        console.log('Comment form found, adding event listeners');
        
        // Handle form submission
        form.addEventListener('submit', function(e) {
            console.log('Form submit event triggered');
            e.preventDefault();
            e.stopPropagation();
            window.submitComment();
            return false;
        });
        
        // Handle Enter key press on input
        const commentInput = form.querySelector('input[name="body"]');
        if (commentInput) {
            console.log('Comment input found, adding keypress listener');
            commentInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    console.log('Enter key pressed');
                    e.preventDefault();
                    e.stopPropagation();
                    window.submitComment();
                    return false;
                }
            });
        } else {
            console.error('Comment input not found');
        }
    } else {
        console.error('Comment form not found');
    }
};

window.submitComment = function() {
    const form = document.getElementById('comment-form');
    if (!form) return;
    
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalContent = submitBtn.innerHTML;
    
    // Disable submit button and show loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <div class="animate-spin rounded-full h-4 w-4 border-2 border-blue-500 border-t-transparent"></div>
    `;
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'text/html'
        },
        body: formData
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.text();
    })
    .then(html => {
        // Add new comment to the list
        const commentList = document.getElementById('comment-list');
        
        // Remove "no comments" message if exists
        const noCommentsMsg = commentList.querySelector('p.text-gray-400');
        if (noCommentsMsg) {
            noCommentsMsg.remove();
        }
        
        // Add new comment at the top
        commentList.insertAdjacentHTML('afterbegin', html);
        
        // Reset form
        form.reset();
        
        // Setup the new comment element
        window.setupCommentElements();
        
        console.log('Comment added successfully');
    })
    .catch(error => {
        console.error('Comment submission error:', error);
        alert('Gagal menambahkan komentar. Silakan coba lagi.');
    })
    .finally(() => {
        // Re-enable submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalContent;
    });
};

window.editComment = function(commentId) {
    console.log('Edit comment:', commentId);
    const commentDiv = document.querySelector(`[data-comment-id='${commentId}']`);
    if (!commentDiv) {
        console.error('Comment div not found for ID:', commentId);
        return;
    }
    
    const bodyText = commentDiv.querySelector('.comment-body').innerText;
    commentDiv.querySelector('.comment-body').style.display = 'none';
    
    let form = document.createElement('form');
    form.className = 'flex gap-2 mt-1';
    form.innerHTML = `
        <input type="text" name="body" value="${bodyText}" class="flex-1 bg-gray-800 border border-gray-600 rounded px-2 py-1 text-white" required />
        <button type="submit" class="text-blue-400 hover:text-blue-300 text-xs px-2 py-1 rounded">Simpan</button>
        <button type="button" class="text-gray-400 hover:text-gray-300 text-xs px-2 py-1 rounded" onclick="window.cancelEdit(this, commentDiv)">Batal</button>
    `;
    
    form.onsubmit = function(e) {
        e.preventDefault();
        const body = form.body.value;
        console.log('Submitting edit:', { commentId, body });
        
        fetch(`/comments/${commentId}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'text/html',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ body })
        })
        .then(res => {
            console.log('Edit response status:', res.status);
            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            return res.text();
        })
        .then(html => {
            console.log('Edit success, updating HTML');
            commentDiv.outerHTML = html;
        })
        .catch(error => {
            console.error('Edit error:', error);
            alert('Gagal mengedit komentar. Silakan coba lagi.');
            // Restore original comment
            commentDiv.querySelector('.comment-body').style.display = '';
            form.remove();
        });
    };
    
    commentDiv.appendChild(form);
};

window.cancelEdit = function(button, commentDiv) {
    button.closest('form').remove();
    commentDiv.querySelector('.comment-body').style.display = '';
};

window.deleteComment = function(commentId) {
    console.log('Delete comment:', commentId);
    if (!confirm('Hapus komentar ini?')) return;
    
    fetch(`/comments/${commentId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(res => {
        console.log('Delete response status:', res.status);
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
    })
    .then(data => {
        console.log('Delete response:', data);
        if (data.success) {
            const commentDiv = document.querySelector(`[data-comment-id='${commentId}']`);
            if (commentDiv) {
                commentDiv.remove();
                console.log('Comment removed from DOM');
                
                // Check if no comments left and show message
                const commentList = document.getElementById('comment-list');
                if (commentList.children.length === 0) {
                    commentList.innerHTML = '<p class="text-gray-400 text-sm text-center py-8">Belum ada komentar</p>';
                }
            }
        } else {
            throw new Error('Delete failed');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        alert('Gagal menghapus komentar. Silakan coba lagi.');
    });
};

window.setupCommentElements = function() {
    document.querySelectorAll('#comment-list > div').forEach(function(div) {
        const id = div.querySelector('[onclick^="editComment"]')?.getAttribute('onclick')?.match(/\d+/)?.[0];
        if (id) {
            div.setAttribute('data-comment-id', id);
            console.log('Set data-comment-id:', id, 'for element:', div);
        }
        const bodyElement = div.querySelector('.comment-body');
        if (bodyElement) {
            bodyElement.classList.add('comment-body');
        }
    });
};

// Setup comment form submission - called directly when modal is loaded
console.log('Scene modal script loaded, setting up comment form');
window.setupCommentForm();
window.setupCommentElements();
</script>
</body>
</html>