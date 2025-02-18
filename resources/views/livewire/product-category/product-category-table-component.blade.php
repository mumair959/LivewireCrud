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
                <th scope="col">{{__('Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($product_categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>
                    <a href="{{route('product_category.edit', ['id' => $category->id])}}" class="btn btn-sm btn-outline-success">{{__('Update')}}</a>
                    <button type="button" wire:click="delete({{ $category->id }})" class="btn btn-sm btn-outline-danger">{{__('Delete')}}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
