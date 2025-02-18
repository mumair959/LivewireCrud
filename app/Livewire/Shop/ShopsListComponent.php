<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use Livewire\Component;

class ShopsListComponent extends Component
{
    public $shops, $search, $keyword;

    public function render()
    {
        $this->shops = Shop::with(['user', 'createdBy', 'shopImages']);

        if (!empty($this->keyword)) {     
            $this->shops = $this->shops->where(function ($query){
                $query->where('name', 'Like', "%{$this->keyword}%")
                    ->orWhere('city', 'Like', "%{$this->keyword}%")
                    ->orWhere('description', 'Like', "%{$this->keyword}%")
                    ->orWhere('location_note', 'Like', "%{$this->keyword}%");
            });
            $this->search = $this->keyword;
        }
        else{
            $this->search = null;
        }

        $this->shops = $this->shops->get();
        
        return view('livewire.shop.shops-list-component');
    }

    function filterShops($keyword)  {
        if (empty($keyword)) {
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('dashboard', [ 'keyword' => $keyword ]);
        }
        
    }
}
