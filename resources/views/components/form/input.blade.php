<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <input 
        type="{{ $type }}" 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @if($name) @error($name) border-red-500 @enderror @elseif($model) @error($model) border-red-500 @enderror @endif @if($disabled) bg-gray-200 @endif" 
        placeholder="{{ $placeholder }}"
        @if($model) wire:model="{{ $model }}" @endif
        @if($type === "number" && $step) step="{{ $step }}"  @endif
        @if($disabled) disabled @endif 
    >
</div>