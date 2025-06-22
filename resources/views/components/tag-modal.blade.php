@props(['id', 'title', 'action'])

<div id="{{ $id }}" class="hidden fixed inset-0 z-50 grid place-content-center bg-black/50 p-4" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
    <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $title }}</h2>

    <form action="{{ $action }}" method="POST" class="mt-4">
      @csrf
      <label for="name" class="block">
        <span class="text-sm font-medium text-gray-700">Nama Tag</span>
        <input
          type="text"
          name="name"
          id="name"
          class="mt-1 w-full rounded border border-gray-300 shadow-sm sm:text-sm"
          required
        />
      </label>

      <footer class="mt-6 flex justify-end gap-2">
        <button
          type="button"
          onclick="closeModal('{{ $id }}')"
          class="rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-200"
        >
          Cancel
        </button>

        <button
          type="submit"
          class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700"
        >
          Simpan
        </button>
      </footer>
    </form>
  </div>
</div>
