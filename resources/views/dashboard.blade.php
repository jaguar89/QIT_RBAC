<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col sm:flex-row gap-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-xl p-2">Total Categoies</h1>
                    <span class="text-2xl">{{\App\Models\Category::count()}}</span>
                </div>
            </div>
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-xl p-2">Total Products</h1>
                    <span class="text-2xl">{{\App\Models\Product::count()}}</span>
                </div>
            </div>
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-xl p-2">Total Admins</h1>
                    <span class="text-2xl">{{\App\Models\User::role('admin')->count()}}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
