<div
    x-show="confirmTaskStatus"
    x-cloak
    class="fixed w-full h-screen top-0 left-0 flex items-center justify-center bg-black bg-opacity-50 z-30"
>
    <div
        @click.away="confirmTaskStatus = false" 
        class="bg-gray-100 w-1/3"
    >
        <div class="h-10 relative flex items-center justify-center bg-secondary text-gray-100">
            <h3 class="text-lg font-bold">Confirmation</h3>
            <span
                @click="confirmTaskStatus = false" 
                class="absolute text-lg right-3 cursor-pointer text-gray-100 hover:text-gray-300" title="{{ __('Close') }}"
            >
                &#10005;
            </span>
        </div>
        <div class="flex flex-col items-center justify-center py-8">
            <p class="text-lg">{{ __('Are you sure you want to change status of this task?') }}</p>
            <div class="flex items-center justify-center space-x-4 mt-8">
                <x-form.button-cancel @click="confirmTaskStatus = false" />
                <form method="POST" action="{{ $route }}">
                    @csrf
                    @method('PATCH')
                    
                    <x-form.button-confirm />
                </form>
            </div>
        </div>
    </div>
</div>