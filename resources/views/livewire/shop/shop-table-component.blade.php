<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Description')}}</th>
                <th scope="col">{{__('Location Note')}}</th>
                <th scope="col">{{__('Phone')}}</th>
                <th scope="col">{{__('Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
            <tr>
                <td>{{$shop->name}}</td>
                <td>{{$shop->description}}</td>
                <td>{{$shop->location_note}}</td>
                <td>{{$shop->phone}}</td>
                <td>
                    <a href="{{route('shop.edit', ['id' => $shop->id])}}" type="button" class="btn btn-sm btn-outline-success">{{__('Update')}}</a>
                    <button type="button" wire:click="delete({{ $shop->id }})" class="btn btn-sm btn-outline-danger">{{__('Delete')}}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>