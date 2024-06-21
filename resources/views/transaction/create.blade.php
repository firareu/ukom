<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 font-semibold text-lg mb-4">
                    Produk Tersedia
                    <p class="font-medium text-sm mt-2">Silahkan pilih barang yang ingin dibeli</p>
                </div>
                <div class="grid grid-cols-12 lg:gap-5 sm:gap-2">
                    <div class="lg:col-span-8 md:col-span-7 col-span-12 mb-4">
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
                            <div class="px-2 py-2 w-full border-t-2 mb-4">
                                <div class="flex justify-between mb-4">
                                    <h6 class="font-medium text-sm">Total</h6>
                                    <p class="font-bold text-xs leading-loose">
                                        Rp. @rupiah($carts->sum(fn($c) => $c->qty * $c->price))
                                    </p>
                                </div>
                            @endif
                            
                                <a href="{{ route('transaction.cart') }}"
                                    class="block text-center w-full px-4 py-2 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Check out
                                </a>
                            </div>

                        
                        <div class="text-gray-900 font-semibold text-lg mb-4">
                            Kategori Produk
                            <p class="font-medium text-sm mt-2">Silahkan pilih kategori untuk memfilter produk</p>
                        </div>
                        <a href="{{ route('dashboard') }}">
                            <div class="w-full py-2 px-4 mt-2 border rounded flex justify-between">
                                <span>Semua</span>
                                <span> > </span>
                            </div>
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('dashboard') . "?q={$category->name}" }}">
                                <div class="w-full py-2 px-4 mt-2 border rounded flex justify-between">
                                    <span>{{ $category->name }}</span>
                                    <span> > </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
