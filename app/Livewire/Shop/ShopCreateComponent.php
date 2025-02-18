<?php

namespace App\Livewire\Shop;

use App\Models\Shop;
use App\Models\ShopImage;
use App\Models\User;
use App\Models\Category;
use Faker\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ShopCreateComponent extends Component
{
    use WithFileUploads;

    public $description, $city, $location_note, $phone, $email, 
    $whatsapp, $category_ids, $shop_image, $lat, $lng;
    public $product_categories;

    public function render()
    {
        $this->product_categories = Category::select('id', 'name')
        ->withoutGlobalScopes()->get();
        
        return view('livewire.shop.shop-create-component');
    }

    /**
     * This method will create shop.
     *
     * @var array
     */
    public function store()
    {
        $validatedData = $this->validate([
            'description' => 'required|string|max:400',
            'city' => 'required|string|max:100',
            'location_note' => 'required|string|max:400',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'whatsapp' => 'sometimes|nullable|numeric',
            'shop_image' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=780,max_height=400|max:1024',
            'category_ids' => 'required|array|min:1'
        ]);

        $faker = Factory::create();

        try {
            DB::beginTransaction();

            $shop_count = Shop::count();

            // Create Shop User
            $user = User::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $validatedData['email'],
                'password' => Hash::make('password123'),
                'type' => 'Shop'
            ]);

            $validatedData['created_by'] = Auth::user()->id;
            $validatedData['user_id'] = $user->id;
            $validatedData['name'] = $validatedData['city'].' Shop '.($shop_count + 1);

            $shop_params = Arr::except($validatedData, ['email', 'category_ids', 'shop_image']);
            $shop_params['lat'] = $this->lat;
            $shop_params['lng'] = $this->lng;

            // Create Shop
            $shop = Shop::create($shop_params);

            // Sync Shop Categories
            if (count($this->category_ids) > 0) {
                $shop->categories()->sync($this->category_ids);
            }

            // Save images
            $file_name = time().'.'.$this->shop_image->extension(); 
            $this->shop_image->storeAs('images/shops/'.$shop->name, $file_name, 'public');

            ShopImage::create([
                'shop_id' => $shop->id,
                'image_url' => '/images/shops/'.$shop->name.'/'.$file_name,
            ]);
  
            DB::commit();

            session()->flash('message', __('Shop Created Successfully'));

            return redirect()->to('/shop');
            
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', __('Oops! Something went wrong'));
        }
        
    }
}
