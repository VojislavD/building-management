<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <textarea 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 h-32 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 resize-none @if($name) @error($name) border-red-500 @enderror @elseif($model) @error($model) border-red-500 @enderror @endif"
        placeholder="{{ $placeholder }}"
        @if($model) wire:model="{{ $model }}" @endif
    ></textarea>
</div>