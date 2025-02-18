<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShopTableComponent extends Component
{
    public $shops;

    public function render()
    {
        $this->shops = Shop::with(['user', 'createdBy'])->get();
        return view('livewire.shop.shop-table-component');
    }

    /**
     * This method will delete shop.
     *
     * @var array
     */
    public function delete($id)
    {
        $shop = Shop::find($id);
        
        try {
            DB::beginTransaction();
            
            $shop->user()->delete();
            $shop->categories()->delete();
            $shop->delete();

            DB::commit();

            $this->product_categories = Shop::all();
            session()->flash('message', __('Shop Deleted Successfully'));
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', __('Oops! Something went wrong'));
        }
        
    }
}
