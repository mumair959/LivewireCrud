<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use App\Models\Category;
use Livewire\Component;

class ShopUpdateComponent extends Component
{
    public $id, $email, $description, $location_note, $phone, $whatsapp, 
    $category_ids, $lat, $lng;
    public $product_categories;
    
    public function render()
    {
        $shop = Shop::with(['user', 'categories'])->find($this->id);
        $this->description = $shop->description;
        $this->location_note = $shop->location_note;
        $this->phone = $shop->phone;
        $this->whatsapp = $shop->whatsapp;

        $this->email = $shop->user->email;
        $this->category_ids = $shop->categories()->pluck('id')->toArray();

        $this->lat = empty($shop->lat) ? '24.860966' : $shop->lat;
        $this->lng = empty($shop->lng) ? '66.990501' : $shop->lng;

        $this->product_categories = Category::select('id', 'name')
        ->withoutGlobalScopes()->get();

        return view('livewire.shop.shop-update-component');
    }

    /**
     * This method will update shop.
     *
     * @var array
     */
    public function update()
    {
        $validatedData = $this->validate([
            'description' => 'required|string|max:400',
            'location_note' => 'required|string|max:400',
            'phone' => 'required|numeric',
            'whatsapp' => 'sometimes|nullable|numeric'
        ]);

        $shop = Shop::find($this->id);
  
        $validatedData['lat'] = $this->lat;
        $validatedData['lng'] = $this->lng;

        $shop->update($validatedData);
  
        session()->flash('message', __('Shop Updated Successfully'));
    }
}
