<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 font-semibold text-lg">
                    Pengguna
                    <p class="font-medium text-sm mt-2">Daftar Pengguna yang ada di sistem</p>
                </div>
                <div class="m-6 mt-1 p-4 border border-gray-200 rounded">
                    <table class="w-full divide-y divide-gray-200 bg-white text-sm">
                        <thead class="text-left">
                            <tr>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Name</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Date of Birth</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Gender</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Phone Number</th>
                                <th class="whitespace-nowrap p-4 font-bold text-gray-900">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-gray-900">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">{{ $user->birthdate->format('d M Y') }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">{{ $user->gender }}</td>
                                    <td class="whitespace-nowrap p-4 text-gray-700">{{ $user->phone }}</td>
                                    <td class="whitespace-nowrap p-4">
                                        <div class="grid grid-cols-2 gap-2 mt-4">
                                            <button 
                                                onclick="showUserModal('{{ $user->id }}')" 
                                                class="w-full px-4 py-1 bg-indigo-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                View
                                            </button>
                                            <button 
                                                onclick="confirmDelete({{ $user->id }})" 
                                                class="w-full px-4 py-1 bg-red-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 mb-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @foreach($users as $user)
    <div id="userModal{{ $user->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Modal Background -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal Content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">User Information</h3>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500">Nama: {{ $user->name }}</p>
                                <p class="text-sm text-gray-500">Tanggal Lahir: {{ $user->birthdate->format('d M Y') }}</p>
                                <p class="text-sm text-gray-500">Gender: {{ $user->gender }}</p>
                                <p class="text-sm text-gray-500">Nomor Telepon: {{ $user->phone }}</p>
                                <!-- Add more fields as needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button 
                        onclick="closeUserModal('{{ $user->id }}')" 
                        type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Delete Confirmation -->
    <div id="delete-modal-{{ $user->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Konfirmasi Penghapusan User
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak bisa dibatalkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal({{ $user->id }})" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showUserModal(userId) {
            const modal = document.getElementById(`userModal${userId}`);
            modal.classList.remove('hidden');
        }

        function closeUserModal(userId) {
            const modal = document.getElementById(`userModal${userId}`);
            modal.classList.add('hidden');
        }

        function confirmDelete(id) {
            document.getElementById('delete-modal-' + id).classList.remove('hidden');
        }

        function closeDeleteModal(id) {
            document.getElementById('delete-modal-' + id).classList.add('hidden');
        }

        function deleteUser(userId) {
            // Logika untuk menghapus pengguna
            console.log('Deleting user with ID:', userId);
            // Tambahkan logika penghapusan pengguna sesuai kebutuhan
        }
    </script>
</x-app-layout>
