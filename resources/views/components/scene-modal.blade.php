<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="sceneModal" class="fixed inset-0 z-50 bg-transparent bg-opacity-60 backdrop-blur-md flex items-center justify-center transition-opacity duration-300 opacity-0 pointer-events-none">
    <div id="sceneModalContent" class="max-w-6xl w-full mx-auto flex gap-6 relative p-4 transform scale-95 transition duration-300 opacity-0">
        <!-- Tombol Close -->
        <button onclick="closeSceneModal()" class="absolute top-6 left-6 z-10 text-white hover:text-gray-300 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Kiri: Gambar Scene -->
        <div class="flex-1 relative">
            <div class="absolute top-2 left-1/2 transform -translate-x-1/2 z-10">
                <!-- <h2 class="text-white text-lg font-medium tracking-wide">
                    {{ strtoupper($scene->film->title ?? 'SCENE') }}
                </h2> -->
            </div>

            <!-- Tombol Save -->
            @auth
                <button
                    id="saveButton-{{ $scene->id }}"
                    class="absolute top-2 right-2 z-10 bg-[#4F51CD] text-white p-2 rounded-sm transition-all duration-300 group hover:scale-105"
                    aria-label="{{ $isSaved ? 'Remove from Collection' : 'Save to Collection' }}"
                    style="background-color: #4F51CD;"
                    onclick="handleSaveButtonClick({{ $scene->id }}, {{ $isSaved ? 'true' : 'false' }})"
                    data-scene-id="{{ $scene->id }}"
                    data-is-saved="{{ $isSaved ? 'true' : 'false' }}"
                >
                    <!-- SVG Outline (default - not saved) -->
                    <span id="saveIcon-{{ $scene->id }}" class="block transition-all duration-300 {{ $isSaved ? 'hidden' : 'block' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </span>
                    <!-- SVG Fill (saved) -->
                    <span id="unsaveIcon-{{ $scene->id }}" class="block transition-all duration-300 {{ $isSaved ? 'block' : 'hidden' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            @else
                <button
                    class="absolute top-2 right-2 z-10 bg-[#4F51CD] text-white p-2 rounded-sm transition group"
                    aria-label="Save to Collection"
                    style="background-color: #4F51CD;"
                    onclick="openCollectionModal({{ $scene->id }})"
                >
                    <!-- SVG Outline (default) -->
                    <span class="block group-hover:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </span>
                    <!-- SVG Fill (hover) -->
                    <span class="hidden group-hover:block">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            @endauth

            <!-- Gambar utama -->
            <div class="relative rounded-sm overflow-hidden bg-transparent">
                <img
                    src="{{ asset('storage/' . $scene->image) }}"
                    alt="{{ $scene->description }}"
                    class="w-full h-[500px] object-cover"
                />

                <!-- Tags -->
                <div class="absolute bottom-4 left-4">
                    <div class="flex flex-wrap gap-2 text-white text-sm">
                        @foreach ($scene->tags as $tag)
                            <span class="bg-black bg-opacity-50 px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Komentar -->
        <div class="w-80 bg-[#121111] bg-opacity-100 rounded-lg p-4 text-white">
            <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2" id="comment-list">
                @if($scene->comments->count())
                    @foreach($scene->comments as $comment)
                        @include('components.comment-item', ['comment' => $comment])
                    @endforeach
                @else
                    <p class="text-gray-400 text-sm text-center py-8">Belum ada komentar</p>
                @endif
            </div>

            <!-- Form Komentar -->
            @auth
                <div class="mt-6 pt-4 border-t border-gray-700">
                    <form id="comment-form" action="{{ route('scenes.comment', $scene->id) }}" method="POST" class="flex items-center gap-3" novalidate onsubmit="return false;">
                        @csrf
                        <div class="w-8 h-8 bg-gray-600 rounded-full flex-shrink-0"></div>
                        <div class="flex-1">
                            <input
                                type="text"
                                name="body"
                                placeholder="Add your comment..."
                                class="w-full bg-transparent border-b border-gray-600 text-white placeholder-gray-400 pb-2 focus:outline-none focus:border-blue-500 transition"
                                required
                            />
                        </div>
                        <button type="submit" class="text-blue-500 hover:text-blue-400 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2 21l21-9L2 3v7l15 2-15 2v7z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <p class="mt-6 pt-4 border-t border-gray-700 text-sm text-gray-300">
                    <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Login</a> untuk berkomentar.
                </p>
            @endauth
        </div>
    </div>
</div>

<script>
// Function to handle save button click
function handleSaveButtonClick(sceneId, isSaved) {
    if (isSaved === 'true' || isSaved === true) {
        // If already saved, directly toggle (remove from collection)
        toggleSaveScene(sceneId);
    } else {
        // If not saved, show collection modal first
        openCollectionModal(sceneId);
    }
}

// Function to open collection modal
function openCollectionModal(sceneId) {
    console.log('Opening collection modal for scene:', sceneId);

    fetch(`/collections/modal?scene_id=${sceneId}`)
        .then(res => {
            console.log('Response status:', res.status);
            if (!res.ok) {
                throw new Error(`HTTP error! status: ${res.status}`);
            }
            return res.text();
        })
        .then(html => {
            console.log('Modal HTML received, length:', html.length);

            // Hapus modal lama jika ada
            const oldModal = document.getElementById('collectionModal');
            if (oldModal) oldModal.remove();

            // Tambahkan modal baru
            document.body.insertAdjacentHTML('beforeend', html);

            // Set scene_id di form
            const sceneIdInput = document.getElementById('collection-scene-id');
            if (sceneIdInput) {
                sceneIdInput.value = sceneId;
            }

            // Setup form handler
            setupSaveToCollectionForm();

            // Show modal with animation
            setTimeout(() => {
                const modal = document.getElementById('collectionModal');
                const modalContent = modal?.querySelector('div');

                if (modal && modalContent) {
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('opacity-0', 'scale-95');
                    modalContent.classList.add('opacity-100', 'scale-100');
                }
            }, 50);
        })
        .catch(error => {
            console.error('Error loading collection modal:', error);
            showNotification('Gagal memuat modal koleksi. Silakan coba lagi.', 'error');
        });
}

// Function to close collection modal
function closeCollectionModal() {
    const modal = document.getElementById('collectionModal');
    const modalContent = modal?.querySelector('div');

    if (modal && modalContent) {
        // Animate out
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('opacity-100', 'scale-100');
        modalContent.classList.add('opacity-0', 'scale-95');

        // Remove from DOM after animation
        setTimeout(() => {
            if (modal.parentNode) {
                modal.remove();
            }
        }, 300);
    }
}

// Function to setup save to collection form
function setupSaveToCollectionForm() {
    const form = document.getElementById('save-to-collection-form');
    if (form) {
        form.onsubmit = function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Menyimpan...';
            submitBtn.disabled = true;

            const formData = new FormData(form);

            // Debug: log form data
            console.log('Form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            fetch('/collections/add-scene', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => {
                console.log('Save response status:', res.status);
                return res.json();
            })
            .then(data => {
                console.log('Save response data:', data);
                if (data.success) {
                    closeCollectionModal();
                    showNotification('Scene berhasil disimpan ke koleksi!', 'success');
                    
                    // Update the save button state in scene modal
                    const sceneId = formData.get('scene_id');
                    updateSaveButtonState(sceneId, true);
                } else {
                    throw new Error(data.message || 'Gagal menyimpan scene ke koleksi.');
                }
            })
            .catch(error => {
                console.error('Error saving to collection:', error);
                showNotification(error.message || 'Gagal menyimpan scene ke koleksi.', 'error');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        }
    }
}

// Function to update save button state after successful save
function updateSaveButtonState(sceneId, isSaved) {
    const button = document.getElementById(`saveButton-${sceneId}`);
    const saveIcon = document.getElementById(`saveIcon-${sceneId}`);
    const unsaveIcon = document.getElementById(`unsaveIcon-${sceneId}`);
    
    if (button && saveIcon && unsaveIcon) {
        // Update data attribute
        button.setAttribute('data-is-saved', isSaved.toString());
        
        // Update aria-label
        button.setAttribute('aria-label', isSaved ? 'Remove from Collection' : 'Save to Collection');
        
        // Update onclick handler
        button.setAttribute('onclick', `handleSaveButtonClick(${sceneId}, ${isSaved})`);
        
        // Toggle icons
        if (isSaved) {
            saveIcon.classList.add('hidden');
            unsaveIcon.classList.remove('hidden');
        } else {
            unsaveIcon.classList.add('hidden');
            saveIcon.classList.remove('hidden');
        }
    }
}

// Helper function untuk menampilkan notifikasi
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-[10000] px-6 py-3 rounded-lg text-white font-medium transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-600' :
        type === 'error' ? 'bg-red-600' : 'bg-blue-600'
    }`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}

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
