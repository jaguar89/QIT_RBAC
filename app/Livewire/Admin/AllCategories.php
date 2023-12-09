<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllCategories extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::latest()->paginate(5);
        return view('livewire.admin.all-categories' , compact('categories'))->layout('layouts.app');
    }

    public function deleteCategory($id){
        $category = Category::find($id);

        if ($category) {
            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
            $category->delete();
            session()->flash('success', 'Category deleted successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
//        return redirect()->route('categories');
        $this->redirect('/categories', navigate: true);
    }
}
