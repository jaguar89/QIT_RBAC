<?php

use App\Livewire\Admin\AllAdmins;
use App\Livewire\Admin\AllCategories;
use App\Livewire\Admin\AllProducts;
use App\Livewire\Admin\ManageAdmin;
use App\Livewire\Admin\ManageCategory;
use App\Livewire\Admin\ManageProduct;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'permission:dashboard-access'])->group(function () {
//    Volt::route('categories', 'admin.all-categories')
//        ->name('categories');
//
//    Volt::route('category/manage', 'admin.manage-category')
//        ->name('manage.category');

    Route::group(['middleware' => ['permission:manage-categories']], function () {
        Route::get('categories', AllCategories::class)->name('categories');
        Route::get('categorys/manage/{id?}', ManageCategory::class)->name('manage.category');
    });


    Route::group(['middleware' => ['permission:manage-products']], function () {
        Route::get('products', AllProducts::class)->name('products');
        Route::get('products/manage/{id?}', ManageProduct::class)->name('manage.product');
    });


    Route::group(['middleware' => ['permission:manage-admins']], function () {
        Route::get('admins', AllAdmins::class)->name('admins');
        Route::get('admins/manage/{id?}', ManageAdmin::class)->name('manage.admin');
    });
});
