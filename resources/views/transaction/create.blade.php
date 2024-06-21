<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <style>
            ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {      
            background: #FFFFFF;    
        }

        ::-webkit-scrollbar-thumb {
            background: #232323;
            border-radius: 10px;
        }

        @media (prefers-color-scheme: dark) {
            ::-webkit-scrollbar-track {      
                background: #FFFFFF;    
            }
            
            ::-webkit-scrollbar-thumb {
                background: #232323;
                border-radius: 10px;
            }
        }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <div class="grid grid-cols-12 lg:gap-5 sm:gap-2">
        <div class="lg:col-span-8 md:col-span-7 col-span-12 mb-4">
            <div class="mb-4">
                <div class="flex justify-between items-center">
                    <div class="text-gray-900 font-semibold text-lg">
                        Produk Tersedia
                        <p class="font-medium text-sm mt-2">Silahkan pilih barang yang ingin dibeli</p>
                    </div>
                    <div class="flex items-center">
                        <span class="mr-2 text-sm text-gray-600">Filter</span>
                        <div class="relative">
                            <select id="category-filter" onchange="filterProducts(this.value)" class="absolute opacity-0 w-full h-full cursor-pointer">
                                <option value="">Semua</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="bg-white border border-gray-300 rounded p-2 focus:outline-none focus:border-gray-500 flex items-center">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                <span id="filter-text" class="ml-2 text-sm text-gray-600">Semua</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid lg:grid-cols-3 sm:grid-cols-2 xs:grid-cols-1 gap-4">
                @foreach ($items as $item)
                    @include('item.partials.card')
                @endforeach
            </div>
        </div>
        <div class="lg:col-span-4 md:col-span-5 col-span-12">
            <div class="text-gray-900 font-semibold text-lg pb-4 border-b-2">
                Keranjang Belanja
                <p class="font-medium text-sm mt-2">Silahkan pilih kategori untuk memfilter produk</p>
            </div>

            @if ($carts->isNotEmpty())
                @foreach ($carts as $cart)
                    @include('item.partials.cart')
                @endforeach
            @else
                <div class="py-4 text-center text-gray-500">
                    Keranjang belanja Anda kosong.
                </div>
            @endif

            <div class="px-2 py-2 w-full border-t-2 mb-4">
                <div class="flex justify-between mb-4">
                    <h6 class="font-medium text-sm">Total</h6>
                    <p class="font-bold text-xs leading-loose">
                        Rp. @rupiah($carts->sum(fn($c) => $c->qty * $c->price))
                    </p>
                </div>

                <a href="{{ route('transaction.cart') }}"
                    class="block text-center w-full px-4 py-2 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $carts->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}">
                    Check out
                </a>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</x-app-layout>

<script>
function filterProducts(category) {
    if (category) {
        window.location.href = "{{ route('dashboard') }}?q=" + encodeURIComponent(category);
    } else {
        window.location.href = "{{ route('dashboard') }}";
    }
}

function updateFilterText() {
    const select = document.getElementById('category-filter');
    const filterText = document.getElementById('filter-text');
    filterText.textContent = select.value || 'Semua';
}

document.addEventListener('DOMContentLoaded', function() {
    updateFilterText();
    
    // Mengatur nilai awal berdasarkan query parameter
    const urlParams = new URLSearchParams(window.location.search);
    const currentCategory = urlParams.get('q');
    if (currentCategory) {
        const select = document.getElementById('category-filter');
        select.value = currentCategory;
        updateFilterText();
    }
});

document.getElementById('category-filter').addEventListener('change', updateFilterText);
</script>
