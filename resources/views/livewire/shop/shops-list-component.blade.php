<div>
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-4 offset-lg-8">
                <input type="text" class="form-control pull-right" wire:model="search" wire:keyup="filterShops($event.target.value)" placeholder="{{__('Enter Search Keywords')}}" autofocus>
            </div>
        </div>
        <div class="row">
            @foreach($shops as $shop)
            <div class="col-lg-4">
                <div class="card">
                    <img src="{{asset('storage'.$shop->shopImages[0]->image_url)}}" class="card-img-top shop-img-list" alt="Shop" />
                    <div class="card-body">
                        <h4 class="card-title font-24"><strong>{{$shop->name}}</strong></h4>
                        <p class="card-text">{{$shop->description}}</p>
                        <a href="{{route('shop.detail', ['id' => $shop->id])}}" class="btn btn-primary pull-right">{{__('View Details')}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
