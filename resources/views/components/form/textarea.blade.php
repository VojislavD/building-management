<div class="flex flex-col">
    <label for="{{ $id }}">{{ $title }}</label>
    <textarea 
        @if($name) name="{{ $name }}" @endif 
        id="{{ $id }}" 
        class="mt-2 h-32 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 resize-none @if($error) @error($error) border-red-500 @enderror @endif"
        placeholder="{{ $placeholder }}"
        @if($model) wire:model.defer="{{ $model }}" @endif
    >@if($value){{$value}}@endif</textarea>
    @if($error)
        <x-form.error-message name="{{ $error }}" />
    @endif
</div>