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
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.36 5.652a.5.5 0 1 0-.707.708L9.293 10l-3.64 3.64a.5.5 0 0 0 .707.708L10 10.707l3.64 3.64a.5.5 0 0 0 .708-.708L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z"/></svg>
                    </span>
                </div>
            @endif
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
                                @include('item.partials.cardAdmin')
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="lg:col-span-4 md:col-span-5 col-span-12">
                        <div id="create-form">
                            @include('items.create', ['categories' => $categories])
                        </div>
                        <div id="update-form" style="display:none;">
                            @include('items.edit', ['categories' => $categories])
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
        
        // Set initial value based on query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const currentCategory = urlParams.get('q');
        if (currentCategory) {
            const select = document.getElementById('category-filter');
            select.value = currentCategory;
            updateFilterText();
        }
    });

    document.getElementById('category-filter').addEventListener('change', updateFilterText);

    function showUpdateForm(itemId) {
        // Menyembunyikan form create
        document.getElementById('create-form').style.display = 'none';
        // Menampilkan form edit
        document.getElementById('update-form').style.display = 'block';

        // Mengambil data item dari server
        fetch(`/items/${itemId}/edit`)
            .then(response => response.json())
            .then(item => {
                // Mengisi form edit dengan data item
                const updateForm = document.getElementById('update-form');
                updateForm.querySelector('#name').value = item.name;
                updateForm.querySelector('#price').value = item.price;
                updateForm.querySelector('#category_id').value = item.category_id;
                updateForm.querySelector('form').action = `/items/${itemId}`;
                
                // Menampilkan gambar saat ini
                const currentImage = updateForm.querySelector('#current-image');
                if (currentImage) {
                    currentImage.src = `/img/products/${item.image}`;
                    currentImage.style.display = 'block';
                }
                
                // Menyimpan nama gambar saat ini
                updateForm.querySelector('#current-image-name').value = item.image;
            });
    }

    function cancelUpdate() {
        // Menyembunyikan form edit
        document.getElementById('update-form').style.display = 'none';
        // Menampilkan form create kembali
        document.getElementById('create-form').style.display = 'block';
    }

</script>
