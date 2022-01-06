@if (session()->has($name))
    <div 
        class="fixed right-8 bottom-16 px-8 py-4 font-semibold rounded-lg bg-opacity-90 z-30 @if($type == 'success') bg-green-300 text-green-800 @elseif($type == 'error') bg-red-300 text-red-800 @endif"
    >
        {{ session($name) }}
    </div>
@endif

