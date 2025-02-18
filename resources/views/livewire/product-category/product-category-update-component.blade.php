<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form>
        <div class="mb-3">
            <label for="pc-name" class="form-label">{{__('Name')}}</label>
            <input type="text" class="form-control" id="pc-name" wire:model="name" placeholder="{{__('Enter Product Category Name')}}">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <label for="pc-description" class="form-label">{{__('Description')}}</label>
            <textarea class="form-control" id="pc-description" rows="3" wire:model="description" placeholder="{{__('Enter Product Category Description')}}"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3 p-3">
            <button wire:click.prevent="update()" class="btn btn-outline-success pull-right">{{__('Update')}}</button>
        </div>
    </form>
</div>
