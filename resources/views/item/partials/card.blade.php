<div class="rounded bg-white border p-4">
    @if(file_exists(public_path('img/products/' . $item->image)))
    <img src="{{ asset('img/products/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
    @else
    <img src="{{ asset('img/products/default.jpg') }}" alt="Default Image" class="w-full h-48 object-cover">
    @endif
    <h6 class="font-medium text-md">{{ $item->name }}</h6>
    <span class="font-bold text-xs">Rp. @rupiah($item->price)</span>
    <div class="grid grid-cols-2 gap-2 mt-4">
        <button onclick="openModal({{ $item->id }})" class="w-full px-4 py-1 bg-indigo-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
            View
        </button>
        <form action="{{ route('cart.add', $item) }}" method="POST">
            @csrf
            <button type="submit" class="w-full px-4 py-1 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Buy</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="modal-{{ $item->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h1 class="text-lg leading-6 font-medium text-gray-900 text-center mb-4" >Detail Produk</h1>
                <div class="sm:flex sm:items-start justify-center">
                    
                    <div class="flex items-center">
                        <div class="w-1/2 pr-4">
                            <img src="{{ asset('img/products/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover mb-4">
                            <p class="text-sm text-gray-500">
                                {{ $item->description }}
                            </p>
                        </div>
                        <div class="w-1/2">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ $item->name }}
                                <p class="text-sm font-bold mt-2">
                                    Stok: 46
                                </p>
                                <p class="text-sm font-bold mt-2">
                                    Rp. @rupiah($item->price)
                                </p>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal({{ $item->id }})" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
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
</script>