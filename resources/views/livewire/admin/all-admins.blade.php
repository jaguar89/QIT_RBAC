<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admins') }}
        </h2>
        <nav class="flex space-x-4">
            <a href="{{ route('admins') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                All Admins
            </a>
            <a href="{{ route('manage.admin') }}"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                Create Admin
            </a>
        </nav>
    </div>
</x-slot>

<div class="container mx-auto p-10">
    @if(session('success'))
        <div
            class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
            id="success-message" onclick="document.getElementById('success-message').style.display='none'">
            <div
                class="max-w-sm w-full bg-green-100 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Check Icon -->
                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <table class="min-w-full bg-white shadow-lg rounded-lg">
        <thead>
        <tr>
            <th class=" py-2 px-4 ">Name</th>
            <th class="w-1/5 py-2 px-4">Email</th>
            <th class="w-1/5 py-2 px-4">Role</th>
            <th class="w-1/5 py-2 px-4">Permissions</th>
            <th class="w-24 py-2 px-4">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr class="text-center border border-l-0 border-r-0">
                <td class="py-2 px-4 ">{{ $admin->name }}</td>
                <td class="py-2 px-4 ">{{ $admin->email }}</td>
                <td class="py-2 px-4 ">{{ $admin->getRoleNames() }}</td>
                <td class="py-2 px-4 ">{{ $admin->getPermissionNames() }}</td>
                {{--                <td class="py-2 px-4 border">{{ implode(', ', $admin->getRoleNames()->toArray()) }}</td>--}}
                {{--                <td class="py-2 px-4 border">{{ implode(', ', $admin->getPermissionNames()->toArray()) }}</td>--}}


                <td class="py-2 px-4 flex justify-center items-center space-x-4  {{($loop->index == 0) ? '' : ''}}">
                    <a href="{{ route('manage.admin' ,  ['id' => $admin->id]) }}"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                       wire:navigate>Edit</a>
                    <button wire:click="deleteAdmin({{ $admin->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{--        {{ $categories->links() }} <!-- Pagination links -->--}}
    </div>
</div>

