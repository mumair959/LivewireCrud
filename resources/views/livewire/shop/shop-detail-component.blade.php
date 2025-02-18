<div>
    <div id="shopDetailSlides" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#shopDetailSlides" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#shopDetailSlides" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#shopDetailSlides" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('storage'.$shop->shopImages[0]->image_url)}}" class="d-block w-100 shop-img-detail" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('storage'.$shop->shopImages[0]->image_url)}}" class="d-block w-100 shop-img-detail" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('storage'.$shop->shopImages[0]->image_url)}}" class="d-block w-100 shop-img-detail" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#shopDetailSlides" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#shopDetailSlides" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{__('Name')}}</strong></h4>
                <p>{{$shop->name}}</p>
            </div>
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{_('Phone')}}</strong></h4>
                <p>{{$shop->phone}}</p>
            </div>
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{__('Whatsapp')}}</strong></h4>
                <p>{{$shop->whatsapp}}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{__('Description')}}</strong></h4>
                <p>{{$shop->description}}</p>
            </div>
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{__('Location Note')}}</strong></h4>
                <p>{{$shop->location_note}}</p>
            </div>
            <div class="col-md-4">
                <h4 class="font-16"><strong>{{__('Added By')}}</strong></h4>
                <p>{{$shop->createdBy->first_name.' '.$shop->createdBy->last_name}}</p>
            </div>
        </div>
    </div>   
</div>
