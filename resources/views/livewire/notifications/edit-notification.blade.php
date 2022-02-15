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
                    model="internal_code"
                    id="internal_code" 
                    title="{{ __('Internal Code') }}" 
                    placeholder="{{ __('Internal Code') }}" 
                    disabled="true"
                />
            </div>

            <div>
                <x-form.input 
                    type="text" 
                    model="address"
                    id="address" 
                    title="{{ __('Address') }}" 
                    placeholder="{{ __('Address') }}" 
                    disabled="true"
                />
            </div>
        </div>
    </div>

    <div class="my-16">
        <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Notification') }}</p>

        <div class="grid grid-cols-1 gap-8 my-4">
            <x-form.select 
                model="status" 
                id="status" 
                title="{{ __('Status') }}" 
                :options="[
                    'Scheduled' => \App\Enums\NotificationStatus::Scheduled->value, 
                    'Processing' => \App\Enums\NotificationStatus::Processing->value, 
                    'Finished' => \App\Enums\NotificationStatus::Finished->value, 
                    'Cancelled' => \App\Enums\NotificationStatus::Cancelled->value, 
                ]"
            />
            <x-form.error-message name="status" />
        </div>

        <div class="grid grid-cols-1 gap-8 my-4">
            <div>
                <x-form.input 
                    type="text" 
                    model="subject"
                    id="subject" 
                    title="{{ __('Subject') }}" 
                    placeholder="{{ __('Subject') }}" 
                />
                <x-form.error-message name="subject" />
            </div>

            <div>
                <x-form.textarea
                    model="body"
                    id="body"
                    title="Body"
                    placeholder="{{ __('Notification text goes here...') }}"
                />
                <x-form.error-message name="body" />
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
                        wire:model="via_email"
                    >
                    <label for="via_email">Email</label>
                </div>
                <x-form.error-message name="via_email" />
            </div>

            <div>
                <p>Send Notification At:</p>
                
                <div class="flex items-center space-x-4 mt-4 ml-4">
                    <input 
                        type="date"
                        id="scheduled_date"
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('scheduled_date') border-red-500 @enderror" 
                        min="{{ today()->format('Y-m-d') }}"
                        wire:model="scheduled_date"
                    />
                    <input 
                        type="time"
                        id="scheduled_time"
                        class="py-1 border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0 @error('scheduled_time') border-red-500 @enderror" 
                        min="{{ now()->format('H:i') }}"
                        wire:model="scheduled_time"
                    />
                </div>
                <x-form.error-message name="scheduled_date" />
                <x-form.error-message name="scheduled_time" />
            </div>
        </div>
    </div>

    <div>
        <x-form.submit title="Update" />
    </div>
</form>