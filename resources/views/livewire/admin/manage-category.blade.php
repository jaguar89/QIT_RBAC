<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
        <nav class="flex space-x-4">
            <a href="{{ route('categories') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                All Categories
            </a>
            @can('create-categories')
                <a href="{{ route('manage.category') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                    Create Category
                </a>
            @endcan
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
                <h1 class="text-2xl mb-4">{{$formHeading}}</h1>
                <form wire:submit.prevent="submit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-600">Image:</label>
                        <input type="file" id="image" wire:model.defer="image" name="image"
                               class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <!-- Category Name -->
                    <div class="mb-4">
                        <label for="category_name" class="block text-sm font-medium text-gray-600">Category
                            Name:</label>
                        <input type="text" id="name" wire:model="name" name="name"
                               class="mt-1 p-2 w-full border rounded-md">
                    </div>

                    <!-- Parent Category -->
                    <div class="mb-4">
                        <label for="parent_category" class="block text-sm font-medium text-gray-600">Parent
                            Category:</label>
                        <select id="parent_category" wire:model="parent_id" name="parent_id"
                                class="mt-1 p-2 w-full border rounded-md">
                            <option value="">None</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white p-2 px-6 rounded hover:bg-blue-600">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
