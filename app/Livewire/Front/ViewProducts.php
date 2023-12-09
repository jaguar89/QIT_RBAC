<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ViewProducts extends Component
{
    use WithPagination;

    public $categories;
    public $category_id;
    public $minPrice = 10 ;
    public $maxPrice = 1000 ;
    public $priceRange;

    public function mount(){
        $this->categories = Category::has('products')->get();
    }
    public function render()
    {
        $query = Product::query();

        if($this->category_id){
            $query->where('category_id', $this->category_id);
        }

        if ($this->priceRange) {
            $query->where('price', '<=', $this->priceRange);
        }

        return view('livewire.front.view-products' , ['products' =>  $query->paginate(6)]);
    }

}
