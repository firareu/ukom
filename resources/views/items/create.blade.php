
<div class="">
    <div class="max-w-7xl mx-auto  ">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.36 5.652a.5.5 0 1 0-.707.708L9.293 10l-3.64 3.64a.5.5 0 0 0 .707.708L10 10.707l3.64 3.64a.5.5 0 0 0 .708-.708L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z"/></svg>
                </span>
            </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="text-gray-900 font-semibold text-lg pb-4 border-b-2">
                Tambah Barang Baru
                <p class="font-medium text-sm mt-2">Silakan masukkan detail barang baru</p>
            </div>
            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga Barang</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Barang</label>
                    <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
