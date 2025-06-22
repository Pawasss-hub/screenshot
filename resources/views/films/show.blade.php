<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $film->title }}</title>
    <link rel="stylesheet" href="app.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body x-data="{
    open: false,
    scene: {},
    openModal(data) {
      this.scene = data;
      this.open = true;
    },
    addToCollection(sceneId) {
      alert('Menambahkan scene ID ' + sceneId + ' ke koleksi! (simulasi)');
      this.open = false;
    }
  }"
  >
    <header
      class="relative bg-[url('{{ asset('storage/' . $film->background) }}')] bg-cover bg-center h-screen w-full overflow-hidden"
    >
      <nav class="bg-transparent px-4 py-4 relative z-10">
        <div
          class="max-w-screen-xl mx-auto flex justify-between items-center ml-24"
        >
          <a
            href="#"
            class="text-2xl font-semibold whitespace-nowrap text-white"
          >
            ScreenShot
          </a>
          <a
            href="{{ route('homepage') }}"
            class="text-white font-medium hover:underline mr-[100px] cursor-pointer"
            aria-current="page"
          >
            Home
          </a>
        </div>
      </nav>
      <!-- GRADASI -->
       <div class="absolute inset-0 w-full h-full z-0"
           style="background: linear-gradient(to bottom,
                  {{ $overlay }}00 0%,
                  {{ $overlay }}33 40%,
                  {{ $overlay }}CC 80%,
                  {{ $overlay }}FF 100%)">
      </div>
      <!-- LOGO DAN INFO -->
      <div
        class="relative z-10 flex flex-col mt-[200px] ml-24 max-w-6xl w-full"
      >
        <img
          src="{{ asset('storage/' . $film->logo) }}"
          alt="Logo {{ $film->title }}"
          class="max-w-[378px] max-h-[44px] h-auto object-contain object-left"
            style="width: auto; height: auto;"
        />
        <div class="relative">
          <p class="text-white">
            {{ $film->release_year }} | {{ $film->duration }} Minutes
            | Language: {{ $film->language }}
          </p>
          <br />
          <hr class="border-gray-400 opacity-70" />
        </div>
      </div>
      <!-- POSTER SINOPSIS INFO -->
      <div class="relative z-10 flex flex-col mt-[25px] ml-24 max-w-6xl w-full h-[25]">
        <div class="flex">
          <!-- POSTER -->
          <img
            src="{{ asset('storage/' . $film->poster) }}"
            alt="{{ $film->title }} Poster"
            class="w-[15%] h-auto object-cover rounded-lg max-w-[300px] max-h-[400px]"
          />
          <div class="ml-8 max-w-[40%] h-50">
            <p class="text-white">
              Director: {{ $film->director }}<br />
              Cast: {{ $film->cast }}<br /><br />
              {{ $film->description }}
            </p>
            <div class="mt-8">
              <div class="mt-4 flex flex-wrap gap-2">
                @foreach($film->genres as $genre)
                <div class="border border-white text-white text-center px-5 py-1 rounded-full min-w-[80px]">
                    {{ $genre->name }}
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- MAIN SCENE -->
    <main class=" text-white" style="background-color:{{ $overlay }} ">
    <div class="relative z-10 flex flex-col ml-24 max-w-6xl w-full">
      <hr class="border-gray-400 opacity-70 mt-2 mb-2" />
      <p class="text-center text-l font-bold">GALLERY</p>
      <div class="grid grid-cols-3 gap-4 mt-4">
        @foreach ($film->scenes as $scene)
        <div
          class="relative overflow-hidden shadow-md h-60 cursor-pointer group"
          onclick="openSceneModal({{ $scene->id }})"
        >
          <img
            src="{{ asset('storage/' . $scene->image) }}"
            alt="{{ $scene->description ?? 'Scene image' }}"
            class="w-full h-full object-cover"
          />
        </div>
        @endforeach
      </div>

    </div>
  </main>

    <!-- FOOTER -->
    <!-- FOOTER -->
    <footer class="text-white py-12" style="background-color: {{ $overlay }}">
      <div class="max-w-6xl mx-auto px-24">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Logo & Tagline -->
          <div class="col-span-1 md:col-span-2">
            <h3 class="text-2xl font-bold mb-4">ScreenShot</h3>
            <p class="text-gray-200 mb-4">
              Discover and collect your favorite movie scenes. Create your personal gallery of cinematic moments.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-200 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-200 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-200 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.1.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.750-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z.017-.001z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Home</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Browse Movies</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Collections</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Favorites</a></li>
            </ul>
          </div>

          <!-- About -->
          <div>
            <h4 class="text-lg font-semibold mb-4">About</h4>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">About Us</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Contact</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Privacy Policy</a></li>
              <li><a href="#" class="text-gray-200 hover:text-white transition-colors">Terms of Service</a></li>
            </ul>
          </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-400 border-opacity-30 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-200 text-sm">
            © {{ date('Y') }} ScreenShot. All rights reserved.
          </p>
          <div class="flex items-center space-x-4 mt-4 md:mt-0">
            <span class="text-gray-200 text-sm">From</span>
            <span class="text-lg font-bold">{{ $film->title }}</span>
          </div>
        </div>
      </div>
    </footer>
       <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
       <script>
       function openSceneModal(sceneId) {
        fetch(`/scenes/${sceneId}/modal`)
          .then((res) => res.text())
          .then((html) => {
            // Hapus modal lama jika ada
            const oldModal = document.getElementById("sceneModal");
            if (oldModal) oldModal.remove();

            // Tambahkan modal baru
            document.body.insertAdjacentHTML("beforeend", html);

            // Delay agar DOM siap
            setTimeout(() => {
              const modal = document.getElementById("sceneModal");
              const content = document.getElementById("sceneModalContent");
              if (modal && content) {
                modal.classList.remove("opacity-0", "pointer-events-none");
                modal.classList.add("opacity-100");
                content.classList.remove("opacity-0", "scale-95");
                content.classList.add("opacity-100", "scale-100");
              }
            }, 50);

            setupCommentForm();
          });
      }

      function closeSceneModal() {
        const modal = document.getElementById("sceneModal");
        const content = document.getElementById("sceneModalContent");
        if (modal && content) {
          // Tambahkan animasi keluar
          modal.classList.remove("opacity-100");
          modal.classList.add("opacity-0", "pointer-events-none");
          content.classList.remove("opacity-100", "scale-100");
          content.classList.add("opacity-0", "scale-95");

          // Tunggu sebelum remove modal dari DOM
          setTimeout(() => modal.remove(), 300);
        }
      }

      function setupCommentForm() {
          const form = document.getElementById('comment-form');
          if (form) {
            form.onsubmit = function(e) {
                  e.preventDefault();
                  const formData = new FormData(form);
                  fetch(form.action, {
                      method: 'POST',
                      headers: {
                          'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                          'Accept': 'text/html'
                      },
                      body: formData
                  })
                  .then(res => res.text())
                  .then(html => {
                      document.getElementById('comment-list').insertAdjacentHTML('beforeend', html);
                      form.reset();
                  });
              }
          }
        }
    </script>
    <script>
// Script untuk collection modal (tambahkan di bawah script yang sudah ada)
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
function handleSaveButtonClick(sceneId, isSaved) {
    if (isSaved === 'true' || isSaved === true) {
        // If already saved, directly toggle (remove from collection)
        toggleSaveScene(sceneId);
    } else {
        // If not saved, show collection modal first
        openCollectionModal(sceneId);
    }
}
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
</script>
<script>
function editComment(commentId) {
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
        <button type="button" class="text-gray-400 hover:text-gray-300 text-xs px-2 py-1 rounded" onclick="cancelEdit(this, commentDiv)">Batal</button>
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
}

function cancelEdit(button, commentDiv) {
    button.closest('form').remove();
    commentDiv.querySelector('.comment-body').style.display = '';
}

function deleteComment(commentId) {
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
            }
        } else {
            throw new Error('Delete failed');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        alert('Gagal menghapus komentar. Silakan coba lagi.');
    });
}

// Initialize comment functionality when modal loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing comment functionality');
    setupCommentElements();
});

// Also setup when modal content is dynamically loaded
function setupCommentElements() {
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
}

// Call setup when modal is opened
if (typeof window !== 'undefined') {
    window.setupCommentElements = setupCommentElements;
}

// Toggle save/unsave scene function
function toggleSaveScene(sceneId) {
    const button = document.getElementById(`saveButton-${sceneId}`);
    const saveIcon = document.getElementById(`saveIcon-${sceneId}`);
    const unsaveIcon = document.getElementById(`unsaveIcon-${sceneId}`);
    
    if (!button) {
        console.error('Save button not found for scene:', sceneId);
        return;
    }
    
    // Disable button during request
    button.disabled = true;
    button.style.opacity = '0.6';
    
    // Add loading animation
    const originalContent = button.innerHTML;
    button.innerHTML = `
        <div class="animate-spin rounded-full h-4 w-4 border-2 border-black border-t-transparent"></div>
    `;
    
    fetch(`/scenes/${sceneId}/toggle-save`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
    })
    .then(data => {
        if (data.success) {
            // Update button state
            const isSaved = data.isSaved;
            
            // Update data attribute
            button.setAttribute('data-is-saved', isSaved.toString());
            
            // Update aria-label
            button.setAttribute('aria-label', isSaved ? 'Remove from Collection' : 'Save to Collection');
            
            // Toggle icons with animation
            if (isSaved) {
                // Show filled icon (saved)
                saveIcon.classList.add('hidden');
                unsaveIcon.classList.remove('hidden');
                
                // Add success animation
                button.classList.add('scale-110');
                setTimeout(() => button.classList.remove('scale-110'), 200);
            } else {
                // Show outline icon (not saved)
                unsaveIcon.classList.add('hidden');
                saveIcon.classList.remove('hidden');
            }
            
            // Show notification
            showNotification(data.message, 'success');
            
            console.log('Scene toggle success:', data);
        } else {
            throw new Error(data.error || 'Failed to toggle save status');
        }
    })
    .catch(error => {
        console.error('Toggle save error:', error);
        showNotification('Failed to update collection. Please try again.', 'error');
    })
    .finally(() => {
        // Restore button
        button.disabled = false;
        button.style.opacity = '1';
        button.innerHTML = originalContent;
    });
}
</script>


  </body>
</html>
