<x-app-layout>
    <h1 class="text-xl font-bold">{{ __('Notification Details') }}</h1>

    <div class="w-full xl:w-2/3 mx-auto">
        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Building Info') }}</p>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Internal Code:') }}</span>
                <span>{{ $notification->building->internal_code }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Address:') }}</span>
                <span>{{ $notification->building->address }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Apartments:') }}</span>
                <span>{{ $notification->building->apartments->count() }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold"></span>
                <a href="{{ route('buildings.show', $notification->building) }}" class="underline">{{ __('View Building') }}</a>
            </div>
        </div>

        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Notification Info') }}</p>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Status:') }}</span>
                <span class="w-full">{!! $notification->status->label() !!}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Via Email:') }}</span>
                <span class="w-full">{!! $notification->viaEmailLabel() !!}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Subject:') }}</span>
                <span class="w-full">{{ $notification->subject }}</span>
            </div>
            
            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Body:') }}</span>
                <span class="w-full">{{ $notification->body }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Send At:') }}</span>
                <span class="w-full">{{ $notification->send_at }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Created At:') }}</span>
                <span class="w-full">{{ $notification->created_at }}</span>
            </div>

            <div class="my-4 flex items-center">
                <span class="w-36 font-bold">{{ __('Updated At:') }}</span>
                <span class="w-full">{{ $notification->updated_at }}</span>
            </div>
        </div>

        <div class="my-16">
            <p class="w-full text-gray-500 uppercase text-sm py-1 border-b border-gray-300">{{ __('Recipients Info') }}</p>

            @forelse ($notification->building->allTenants() as $recipient)
                <div class="bg-white my-2 px-4 py-2 rounded-lg border border-gray-300">
                    <div class="my-4 flex items-center">
                        <span class="w-36 font-bold">{{ __('Name:') }}</span>
                        <span class="w-full">{{ $recipient->name }}</span>
                    </div>
                    <div class="my-4 flex items-center">
                        <span class="w-36 font-bold">{{ __('Email:') }}</span>
                        <span class="w-full">{{ $recipient->email }}</span>
                    </div>
                    <div class="my-4 flex items-center">
                        <span class="w-36 font-bold">{{ __('Phone:') }}</span>
                        <span class="w-full">{{ $recipient->phone }}</span>
                    </div>
                </div>
            @empty
                <div class="my-4 flex items-center">
                    <span>{{ __('There is no any recipients for this notification.') }}</span>
                </div>
            @endforelse
        </div>
    </div>

</x-app-layout>