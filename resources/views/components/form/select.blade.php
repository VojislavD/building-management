<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <select 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 @if($name) @error($name) border-red-500 @enderror @elseif($model) @error($model) border-red-500 @enderror @endif"
        @if($model) wire:model="{{ $model }}" @endif
    >
        <option></option>
        @foreach ($options as $name => $value)
            <option value="{{ $value }}">{{ $name }}</option>   
        @endforeach
    </select>
</div>
