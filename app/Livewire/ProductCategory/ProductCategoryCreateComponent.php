<?php

namespace App\Livewire\ProductCategory;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCategoryCreateComponent extends Component
{
    public $name, $description;

    public function render()
    {
        return view('livewire.product-category.product-category-create-component');
    }

    /**
     * This method will create product category.
     *
     * @var array
     */
    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'required|string|max:400',
        ]);
  
        $validatedData['created_by'] = Auth::user()->id;
        
        Category::create($validatedData);
  
        session()->flash('message', __('Product Category Created Successfully'));
  
        return redirect()->to('/product-category');
    }

}
