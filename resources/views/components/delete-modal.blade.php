<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 px-4">

    <div class="w-full max-w-md rounded-2xl bg-white p-7 text-center shadow-2xl">

        <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-red-100">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-10 w-10 text-red-600"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>
            </svg>
        </div>

        <h2 class="mb-2 text-2xl font-bold text-gray-800">
            Hapus Data?
        </h2>

        <p class="mb-6 text-sm leading-relaxed text-gray-500">
            Apakah kamu yakin ingin menghapus data ini?
            <br>
            Data yang sudah dihapus tidak dapat dikembalikan.
        </p>

        <div class="flex justify-center gap-3">

            <button type="button"
                    onclick="closeDeleteModal()"
                    class="rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                Batal
            </button>

            <button type="button"
                    onclick="confirmDelete()"
                    class="rounded-lg bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                Ya, Hapus
            </button>

        </div>
    </div>
</div>

<script>
    let selectedDeleteForm = null;

    function openDeleteModal(form) {
        selectedDeleteForm = form;

        const modal = document.getElementById('deleteModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        return false;
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');

        selectedDeleteForm = null;
    }

    function confirmDelete() {
        if (selectedDeleteForm) {
            selectedDeleteForm.submit();
        }
    }
</script>
