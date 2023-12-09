<?php

namespace App\Livewire\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use function PHPUnit\Framework\isEmpty;

class ManageCategory extends Component
{
    use WithFileUploads;

    public $categories;
    public $name;
    public $image;
    public $parent_id;
    public $category;
    public string $formHeading = 'Create Category';

    public function mount($id = null)
    {
        if ($id) {
            $this->categories = Category::where('id', '!=', $id)->get();
            $this->category = Category::findOrFail($id);

            $this->name = $this->category->name;
            $this->parent_id = $this->category->parent_id;

            $this->formHeading = 'Update Category';
        } else {
            $this->categories = Category::all();
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-category')->layout('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'image' => $this->category ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
            'parent_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $parentCategory = Category::find($value);
                    if ($parentCategory && $parentCategory->products()->exists()) {
                        $fail("The parent category cannot have products.");
                    }
                },
            ],
        ]);

        $data = [
            'name' => $this->name,
            'parent_id' => empty($this->parent_id) ? null : $this->parent_id,
        ];
        if ($this->category) {
            // update
            if ($this->image) {
                $data['image'] = $this->image->store('categories', 'public');
            }

            $this->category->update($data);
            session()->flash('success', 'Category updated successfully.');
        } else {
            // create
            $data['image'] = $this->image->store('categories', 'public');
            Category::create($data);
            session()->flash('success', 'Category created successfully.');
        }

//        return redirect()->route('categories');
        $this->redirect('/categories', navigate: true);
    }
}
