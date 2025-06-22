@props(['id', 'itemName', 'deleteRoute'])

<div id="modal-{{ $id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded shadow max-w-sm">
        <h3 class="text-lg font-semibold mb-4">Hapus Tag?</h3>
        <p class="mb-4">Apakah kamu yakin ingin menghapus <strong>{{ $itemName }}</strong>?</p>
        <div class="flex justify-end space-x-2">
            <button onclick="closeModal({{ $id }})" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <form action="{{ $deleteRoute }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>
