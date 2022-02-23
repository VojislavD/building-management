<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <input 
        type="{{ $type }}" 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @if($error) @error($error) border-red-500 @enderror @endif @if($disabled) bg-gray-200 @endif" 
        placeholder="{{ $placeholder }}"
        @if($model) wire:model.defer="{{ $model }}" @endif
        @if($type === "number" && $step) step="{{ $step }}"  @endif
        @if($disabled) disabled @endif 
    >
    @if($error)
        <x-form.error-message name="{{ $error }}" />
    @endif
</div>