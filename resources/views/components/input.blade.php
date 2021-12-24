<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0" 
        placeholder="{{ $placeholder }}"
    >
</div>