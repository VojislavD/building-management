<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <select 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 @if($name) @error($name) border-red-500 @enderror @elseif($model) @error($name) border-red-500 @enderror @endif"
    >
        <option></option>
        @foreach ($options as $name => $value)
            <option value="{{ $value }}">{{ $name }}</option>   
        @endforeach
    </select>
</div>
