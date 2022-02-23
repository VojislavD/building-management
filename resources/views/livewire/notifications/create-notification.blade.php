<form 
    class="w-full xl:w-2/3 mx-auto"
    wire:submit.prevent="submit"
>
    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Building Info') }}</p>

        <div class="grid grid-cols-2 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.internal_code"
                    id="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                    disabled="true"
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="state.address"
                    id="address" 
                    title="{{ __('Address') }}" 
                    placeholder="{{ __('Address') }}" 
                    disabled="true"
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Message') }}</p>

        <div class="grid grid-cols-1 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="state.subject"
                    id="subject" 
                    error="subject" 
                    title="{{ __('Subject') }}" 
                    placeholder="{{ __('Subject') }}" 
                />
            </div>

            <div>
                <x-form.textarea
                    model="state.body"
                    id="body"
                    error="body"
                    title="Body"
                    placeholder="{{ __('Notification text goes here...') }}"
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Settings') }}</p>

        <div class="grid grid-cols-1 gap-8 my-4">
            <div>
                <p>Send Notification Via:</p>
                <div class="flex items-center space-x-2 mt-4 ml-4">
                    <input 
                        type="checkbox" 
                        id="via_email" 
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('via_email') border-red-500 @enderror" 
                        wire:model.defer="state.via_email"
                    >
                    <label for="via_email">Email</label>
                </div>
                <x-form.error-message name="via_email" />
            </div>

            <div x-data="{ scheduled: false }">
                <p>Send Notification:</p>
                <div class="flex items-center space-x-2 mt-4 ml-4">
                    <input 
                        @click="scheduled = false"
                        wire:click="sendImmediately"
                        type="radio" 
                        id="send_immediately" 
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('schedule_at') border-red-500 @enderror" 
                        wire:model.defer="state.send_immediately"
                    >
                    <label for="send_immediately">Immediately</label>
                </div>
                <div class="flex items-center space-x-2 mt-4 ml-4">
                    <input 
                        @click="scheduled = true"
                        wire:click="sendScheduled"
                        type="radio" 
                        id="send_scheduled" 
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('schedule_at') border-red-500 @enderror" 
                        wire:model.defer="state.send_scheduled"
                    >
                    <label for="send_scheduled">Scheduled</label>
                </div>
                <div
                    x-show="scheduled"
                    x-cloak 
                    class="flex items-center space-x-4 mt-4 ml-4"
                >
                    <label for="scheduled_date">Send At:</label>
                    <input 
                        type="date"
                        id="scheduled_date"
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('scheduled_date') border-red-500 @enderror" 
                        min="{{ today()->format('Y-m-d') }}"
                        wire:model.defer="state.scheduled_date"
                    />
                    <input 
                        type="time"
                        id="scheduled_time"
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('scheduled_time') border-red-500 @enderror" 
                        min="{{ now()->format('H:i') }}"
                        wire:model.defer="state.scheduled_time"
                    />
                </div>
                <x-form.error-message name="scheduled_date" />
                <x-form.error-message name="scheduled_time" />
            </div>
        </div>
    </div>

    <div>
        <x-form.submit title="Send" />
    </div>
</form>