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
                                    <a
                                        href="#"
                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                    >
                                        View
                                    </a>
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
</x-app-layout>