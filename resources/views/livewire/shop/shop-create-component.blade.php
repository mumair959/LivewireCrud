<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="sh-email" class="form-label">{{__('Email Address')}}</label>
                    <input type="text" class="form-control" id="sh-email" wire:model="email" placeholder="{{__('Enter Email Address')}}">
                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4">
                    <label for="sh-phone" class="form-label">{{__('Phone')}}</label>
                    <input type="text" class="form-control" id="sh-phone" wire:model="phone" placeholder="{{__('Enter Phone Number')}}">
                    @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4">
                    <label for="sh-whatsapp" class="form-label">{{__('Whatsapp')}}</label>
                    <input type="text" class="form-control" id="sh-whatsapp" wire:model="whatsapp" placeholder="{{__('Enter Whatsapp Number')}}">
                    @error('whatsapp') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="sh-description" class="form-label">{{__('Description')}}</label>
                    <textarea class="form-control" id="sh-description" rows="3" wire:model="description" placeholder="{{__('Enter Shop Description')}}"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4">
                    <label for="sh-location-note" class="form-label">{{__('Location Note')}}</label>
                    <textarea class="form-control" id="sh-location-note" rows="3" wire:model="location_note" placeholder="{{__('Enter Shop Location Note')}}"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4">
                    <label for="sh-city" class="form-label">{{__('City')}}</label>
                    <input type="text" class="form-control" id="sh-city" wire:model="city" placeholder="{{__('Enter City Name')}}">
                    @error('city') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <div wire:ignore>
                        <label for="select2-categories" class="form-label">{{__('Product Categories')}}</label>
                        <select class="form-select" id="select2-categories" data-placeholder="{{__('Select Product Categories')}}" multiple="multiple">
                            @foreach($product_categories as $product_category)
                                <option value="{{$product_category->id}}">{{$product_category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_ids') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-4">
                    <label for="sh-image-1" class="form-label">{{__('Select Image')}}</label>
                    <input type="file" class="form-control" id="sh-image-1" wire:model="shop_image" placeholder="Select Shop Image...">
                    @error('shop_image') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row mb-3 h-300" wire:ignore>
                <div id="google-map"></div>
            </div>
        </div>
        
        <div class="mb-3 p-3">
            <button wire:click.prevent="store()" class="btn btn-outline-success pull-right">{{__('Create')}}</button>
        </div>
    </form>
</div>

@push('custom-scripts')
    <script>
        // On Load jQuery
        $(document).ready(function() {
            $('#select2-categories').select2({
                placeholder: '{{__('Select your option')}}',
                allowClear: true
            });
            $('#select2-categories').on('change', function (e) {
                var data = $('#select2-categories').select2("val");
                @this.set('category_ids', data);
            });
        });

        // Google map JS Code
        function initMap() {
            const myLatLng = { lat: 24.860966, lng: 66.990501 };
            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 5,
                center: myLatLng,
            });

            map.addListener("click", function(event) {
                mapClicked(event, map);
            });
    
            const marker = new google.maps.Marker({
                position: myLatLng,
                map
            });
        }
  
        window.initMap = initMap;

        function mapClicked(event, prev_map) {
            const myLatLng = { lat: event.latLng.lat(), lng: event.latLng.lng() };

            @this.set('lat', event.latLng.lat());
            @this.set('lng', event.latLng.lng());
            
            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: prev_map.getZoom(),
                center: myLatLng,
            });

            map.addListener("click", function(event) {
                mapClicked(event, map);
            });
            
            const marker = new google.maps.Marker({
                position: myLatLng,
                map
            });
        }
    </script>

    <!-- Google Map -->
    <script async type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('app.google_map_key') }}&callback=initMap" ></script>
@endpush