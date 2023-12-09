<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageProduct extends Component
{
    use WithFileUploads;

    public $categories;
    public $name;
    public $description;
    public $price;
    public $image;
    public $product;
    public $category_id;
    public string $formHeading = 'Create Product';

    public function mount($id = null)
    {
        $this->categories = Category::all();
        if ($id) {
            $this->product = Product::findOrFail($id);

            $this->name = $this->product->name;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            $this->category_id = $this->product->category_id;

            $this->formHeading = 'Update Product';
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-product')->layout('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => $this->product ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $category = Category::find($value);

                    if ($category && $category->subcategories()->exists()) {
                        $fail("The category cannot have subcategories.");
                    }
                },
            ],
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ];

        $categoyName = Category::find($this->category_id)->name;
        if ($this->product) {
            // update
            if ($this->image) {
                $data['image'] = $this->image->store('products/' . $categoyName, 'public');
            }

            $this->product->update($data);
            session()->flash('success', 'Product updated successfully.');
        } else {
            // create
            $data['image'] = $this->image->store('products/' . $categoyName, 'public');
            Product::create($data);
            session()->flash('success', 'Product created successfully.');
        }

//        return redirect()->route('products');
        $this->redirect('/products', navigate: true);
    }
}
