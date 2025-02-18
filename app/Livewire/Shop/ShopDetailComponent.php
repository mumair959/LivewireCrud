<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;

class ShopDetailComponent extends Component
{
    public $id, $shop;

    public function render()
    {
        $this->shop = Shop::with('createdBy','shopImages')->find($this->id);

        return view('livewire.shop.shop-detail-component');
    }
}
