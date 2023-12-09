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

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if ($errors->any())
                <div id="error-message"
                     class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
                    <div
                        class="max-w-sm w-full bg-red-100 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="ml-3 w-0 flex-1 pt-0.5">
                                    <p class="text-sm font-medium text-red-800">
                                        There were some errors with your submission:
                                    </p>
                                    <ul class="mt-1 text-sm text-red-600 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="ml-4 flex-shrink-0 flex">
                                    <!-- Close Icon -->
                                    <button onclick="document.getElementById('error-message').style.display='none'"
                                            class="bg-red-100 rounded-md inline-flex text-red-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <span class="sr-only">Close</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                             fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414L11.414 13l2.293 2.293a1 1 0 01-1.414 1.414L10 14.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 13 6.293 10.707a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class=" p-6 rounded-lg ">
                <h1 class="text-2xl mb-4">{{ $formHeading }}</h1>
                <form wire:submit="register">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')"/>
                        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                                       autofocus autocomplete="name"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                                       autocomplete="username"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__($passwordLabel)"/>

                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                       autocomplete="new-password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__($confirmedPasswordLabel)"/>

                        <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                      class="block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation"  autocomplete="new-password"/>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                    </div>

                    <!-- Permissions -->
                    <div class="mt-4">
                        <x-input-label :value="__('Permissions:')" class="mt-8 mb-6 py-4  border-b-2 " />
                        <div class="flex items-start space-x-8">
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.dashboard-access" id="dashboard-access"/>
                                <x-input-label for="dashboard-access" :value="__('Dashboard Access')"/>
                            </div>
{{--                            <div>--}}
{{--                                <x-checkbox wire:model="permissions.manage-products" id="manage-products"/>--}}
{{--                                <x-input-label for="manage-products" :value="__('Manage Products')"/>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <x-checkbox wire:model="permissions.manage-categories" id="manage-categories"/>--}}
{{--                                <x-input-label for="manage-categories" :value="__('Manage Categories')"/>--}}
{{--                            </div>--}}
                        </div>
                        <x-input-label :value="__('Categories:')" class="mt-8 mb-2" />
                        <div class="flex items-start space-x-8">
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.read-categories" id="read-categories"/>
                                <x-input-label for="read-categories" :value="__('Read Category')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.create-categories" id="create-categories"/>
                                <x-input-label for="create-categories" :value="__('Create Category')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.update-categories" id="update-categories"/>
                                <x-input-label for="update-categories" :value="__('Update Category')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.delete-categories" id="delete-categories"/>
                                <x-input-label for="delete-categories" :value="__('Delete Category')"/>
                            </div>
                        </div>
                        <x-input-label :value="__('Products:')" class="mt-8 mb-2" />
                        <div class="flex items-start space-x-8">
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.read-products" id="read-products"/>
                                <x-input-label for="read-products" :value="__('Read Product')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.create-products" id="create-products"/>
                                <x-input-label for="create-products" :value="__('Create Product')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.update-products" id="update-products"/>
                                <x-input-label for="update-products" :value="__('Update Product')"/>
                            </div>
                            <div class="flex flex-row gap-1">
                                <x-checkbox wire:model="permissions.delete-products" id="delete-products"/>
                                <x-input-label for="delete-products" :value="__('Delete Product')"/>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-2"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
