<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <select 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 @if($error) @error($error) border-red-500 @enderror @endif"
        @if($model) wire:model.defer="{{ $model }}" @endif
    >
        <option></option>
        @foreach ($options as $name => $value)
            <option value="{{ $value }}">{{ $name }}</option>   
        @endforeach
    </select>
    @if($error)
        <x-form.error-message name="{{ $error }}" />
    @endif
</div>
