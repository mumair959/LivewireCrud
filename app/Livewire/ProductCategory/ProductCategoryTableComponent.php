<?php

namespace App\Livewire\ProductCategory;
use App\Models\Category;
use Livewire\Component;

class ProductCategoryTableComponent extends Component
{
    public $product_categories;

    public function render()
    {
        $this->product_categories = Category::all();
        return view('livewire.product-category.product-category-table-component');
    }

    /**
     * This method will delete product category.
     *
     * @var array
     */
    public function delete($id)
    {
        Category::find($id)->delete();
        $this->product_categories = Category::all();
        session()->flash('message', __('Product Category Deleted Successfully'));
    }
}
