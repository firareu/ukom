<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <form action="{{ route('transaction.store') }}" method="POST">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="w-full flex justify-between border-b-2">
                        <div class="text-gray-900 font-semibold text-lg mb-4">
                            Keranjang Belanja
                            <p class="font-medium text-sm mt-2">Tinggal satu langkah lagi untuk membeli barang yang kamu
                                inginkan
                            </p>
                        </div>
                        <div>



                        </div>
                    </div>

                    <table class="w-full divide-y divide-gray-200 bg-white text-sm mt-4">
                        <thead class="text-center">
                            <tr>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">No</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Product</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Price</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Quantity</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="text-center whitespace-nowrap p-4 text-gray-900">{{ $loop->iteration }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">{{ $cart->name }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        <div class="flex justify-between">
                                            <span>Rp.</span>
                                            <span>@rupiah($cart->price)</span>
                                        </div>
                                    </td>
                                    <td class="text-center whitespace-nowrap p-4 text-gray-700">x{{ $cart->qty }}
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        <div class="flex justify-between">
                                            <span>Rp.</span>
                                            <span>@rupiah($cart->price * $cart->qty)</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="grid grid-cols-2 gap-4 items-center mt-4">
                        <div class="py-4">
                            <div class="text-gray-900 font-semibold mb-4">
                                Silahkan pilih metode pembayaran
                                <p class="font-medium text-sm mt-1">Tinggal satu langkah lagi untuk membeli barang yang
                                    kamu
                                    inginkan
                                </p>
                            </div>
                            <div class="flex ">
                                <label class="relative cursor-pointer mr-1">
                                    <input type="radio" name="payment_method" class="sr-only peer" value="credit" />
                                    <div
                                        class="mr-1 ring-1 ring-indigo-300 px-4 py-2 object-cover border-2 border-transparent peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-indigo-500 rounded-md">
                                        Kartu Kredit
                                    </div>
                                </label>
                                <label class="relative cursor-pointer mr-1">
                                    <input type="radio" name="payment_method" class="sr-only peer" value="debit" />
                                    <div
                                        class="mr-1 ring-1 ring-indigo-300 px-4 py-2 object-cover border-2 border-transparent peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-indigo-500 rounded-md">
                                        Kartu Debit
                                    </div>
                                </label>
                                <label class="relative cursor-pointer mr-1">
                                    <input type="radio" name="payment_method" class="sr-only peer" value="cod" />
                                    <div
                                        class="mr-1 ring-1 ring-indigo-300 px-4 py-2 object-cover border-2 border-transparent peer-checked:border-blue-500 peer-checked:ring-2 peer-checked:ring-indigo-500 rounded-md">
                                        Cash On Delivery
                                    </div>
                                </label>
                            </div>

                        </div>
                        <div class="float-right text-right">
                            <span class="font-base">Total (Termasuk Pajak)</span>
                            <p class="font-bold text-2xl text-indigo-700">
                                Rp. @rupiah($carts->sum(fn($c) => $c->qty * $c->price))
                            </p>
                        </div>
                    </div>
                    @csrf
                    <button type="submit"
                        class="block text-center w-full px-4 py-2 bg-green-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Check out
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
