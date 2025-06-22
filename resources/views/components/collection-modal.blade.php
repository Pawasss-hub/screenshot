<div id="collectionModal" class="fixed inset-0 z-[9999] bg-transparent bg-opacity-50 backdrop-blur-md flex items-center justify-center transition-opacity duration-300 opacity-0 pointer-events-none">
    <div class="bg-gray-900 rounded-lg max-w-md w-full mx-4 p-6 relative border-2 border-[#313030] transform scale-95 transition duration-300 opacity-0">
        <button onclick="closeCollectionModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white text-2xl transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
        </button>
        <h2 class="text-white text-lg font-bold mb-4">Simpan ke Koleksi</h2>
        @if($collections->count() > 0)
        <form id="save-to-collection-form">
                <input type="hidden" name="scene_id" id="collection-scene-id" value="{{ $scene_id ?? '' }}">
            <div class="mb-4">
                    <label for="collection_id" class="block mb-2 text-white text-sm font-medium">Pilih Koleksi:</label>
                    <select name="collection_id" id="collection_id" class="w-full bg-gray-800 border-2 border-[#313030] rounded p-3 text-white focus:border-blue-500 focus:outline-none transition-colors" required>
                        <option value="">Pilih koleksi...</option>
                    @foreach($collections as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
            </div>
                <div class="flex gap-3">
                    <button type="button" onclick="closeCollectionModal()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                        Simpan
                    </button>
                </div>
        </form>
        @else
            <div class="text-center py-6">
                <p class="text-gray-300 mb-4">Anda belum memiliki koleksi.</p>
                <a href="{{ route('collections.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                    Buat Koleksi Baru
                </a>
            </div>
        @endif
    </div>
</div>

<script>
// Auto-show modal when loaded
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('collectionModal');
    const modalContent = modal?.querySelector('div');

    if (modal && modalContent) {
        // Show modal with animation
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('opacity-0', 'scale-95');
            modalContent.classList.add('opacity-100', 'scale-100');
        }, 50);
    }
});
</script>

