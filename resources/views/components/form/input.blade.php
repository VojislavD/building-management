<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <input 
        type="{{ $type }}" 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0" 
        placeholder="{{ $placeholder }}"
        @if($model) wire:model="{{ $model }}" @endif
    >
</div>