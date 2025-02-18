<?php

namespace App\Livewire\ProductCategory;

use App\Models\Category;
use Livewire\Component;

class ProductCategoryUpdateComponent extends Component
{
    public $id, $name, $description;

    public function render()
    {
        $product_categories = Category::find($this->id);
        $this->name = $product_categories->name;
        $this->description = $product_categories->description;
        return view('livewire.product-category.product-category-update-component');
    }

    /**
     * This method will update product category.
     *
     * @var array
     */
    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:100|unique:categories,name,'.$this->id,
            'description' => 'required|string|max:400',
        ]);

        $category = Category::find($this->id);
  
        $category->update($validatedData);
  
        session()->flash('message', __('Product Category Updated Successfully'));
    }
}
