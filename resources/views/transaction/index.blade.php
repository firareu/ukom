<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-lg">
                    Transaksi
                    <p class="font-medium text-sm mt-2">Lihat semua transaksimu</p>
                </div>
                <div class="m-6 mt-1 p-4 border border-gray-200 rounded">
                    <table class="w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">No</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Pembeli</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Tanggal Pembelian</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Status</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Total</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        {{ $transaction->user->name }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        {{ $transaction->created_at->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">
                                        @if ($transaction->status == 'pending')
                                            <div class="w-fit px-3 py-1 rounded-full bg-yellow-500 text-white">Menunggu
                                                Pengiriman
                                            </div>
                                        @elseif($transaction->status == 'shipped')
                                            <div class="px-3 py-2 bg-indigo-500 text-white">Menunggu Pengiriman</div>
                                        @elseif($transaction->status == 'done')
                                            <div class="px-3 py-2 bg-green-500 text-white">Menunggu Pengiriman</div>
                                        @else
                                            <div class="px-3 py-2 bg-red-500 text-white">Menunggu Pengiriman</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">Rp. @rupiah($transaction->total)</td>
                                    <td class="whitespace-nowrap p-4">
                                    <a 
                                        href="{{ route('transaction.pdf', $transaction) }}" 
                                        class="inline-flex justify-center px-4 py-2 bg-indigo-600 text-white border border-transparent rounded-md font-medium text-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Cetak PDF
                                    </a>
                                    <button 
                                        type="button" 
                                        onclick="openModal('{{ route('transaction.destroy', $transaction) }}')" 
                                        class="ml-2 inline-flex justify-center px-4 py-2 bg-red-600 text-white border border-transparent rounded-md font-medium text-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 mb-6">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Transaction
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this transaction? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function openModal(deleteUrl) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteForm').action = deleteUrl;
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</x-app-layout>
