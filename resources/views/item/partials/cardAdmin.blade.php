<div class="rounded bg-white border p-4">
    @if(file_exists(public_path('img/products/' . $item->image)))
    <img src="{{ asset('img/products/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
    @else
    <img src="{{ asset('img/products/default.jpg') }}" alt="Default Image" class="w-full h-48 object-cover">
    @endif
    <h6 class="font-medium text-md">{{ $item->name }}</h6>
    <span class="font-bold text-xs">Rp. @rupiah($item->price)</span>
    <div class="grid grid-cols-3 gap-2 mt-4">
        <button onclick="showUpdateForm({{ $item->id }})" class="w-full px-4 py-1 bg-yellow-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center">
            Edit
        </button>

        <button href="{{ route('items.destroy', $item->id) }}" onclick="confirmDelete({{ $item->id }})" class="w-full px-4 py-1 bg-red-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Delete
        </button>
    </div>
</div>

<!-- Modal View -->
<div id="modal-{{ $item->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Modal content remains the same as in your original code -->
</div>

<!-- Modal Delete Confirmation -->
<div id="delete-modal-{{ $item->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                           Konfirmasi Penghapusan
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak bisa dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal({{ $item->id }})" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById('modal-' + id).classList.add('hidden');
}

function confirmDelete(id) {
    document.getElementById('delete-modal-' + id).classList.remove('hidden');
}

function closeDeleteModal(id) {
    document.getElementById('delete-modal-' + id).classList.add('hidden');
}
</script>