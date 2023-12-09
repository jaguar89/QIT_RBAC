<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;


    public function render()
    {
        $products = Product::latest()->paginate(5);
        return view('livewire.admin.all-products' , compact('products'))->layout('layouts.app');
    }

    public function deleteProduct($id){
        $product = Product::find($id);

        if ($product) {
            if($product->image){
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            session()->flash('success', 'Product deleted successfully.');
        } else {
            session()->flash('error', 'Product not found.');
        }
//        return redirect()->route('products');
        $this->redirect('/products', navigate: true);
    }
}
