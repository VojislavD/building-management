<x-app-layout>

    <x-flash-message type="success" name="notificationCreated" />
    
    <x-flash-message type="success" name="apartmentDeleted" />
    <x-flash-message type="error" name="apartmentNotDeleted" />

    <div class="flex items-start justify-between">
        <div>
            <div class="flex items-center space-x-4">
                <span class="text-2xl font-bold" title="{{ __('Address') }}">{{ $building->address }}</span>
                {!! $building->status->label() !!}
                <div class="flex items-center mt-0.5 space-x-1" title="{{ __('Balance') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="font-bold">{{ $building->balance }}</span>
                </div>
            </div>
            <p title="{{ __('City') }}">{{ $building->city }}</p>
            <div class="flex items-center mt-0.5 space-x-6">
                <div class="flex items-center space-x-1" title="{{ __('Apartments') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    <span class="text-sm">{{ $building->apartments()->count() }}</span>
                </div>
                <div class="flex items-center space-x-1" title="{{ __('Tenants') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="text-sm">{{ $building->tenantsSum() }}</span>
                </div>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a 
                href="{{ route('buildings.edit', $building) }}" 
                class="flex items-center justify-center space-x-1 hover:text-primary" 
                title="Edit"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span class="text-sm">{{ __('Edit') }}</span>
            </a>
            <a 
                href="{{ route('notifications.create', $building) }}" 
                class="flex items-center justify-center space-x-1 hover:text-primary" 
                title="Edit"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                <span class="text-sm">{{ __('Send Notification') }}</span>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-8 mt-12">
        <div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <p class="text-lg font-semibold text-teal-600">{{ __('Basic Info') }}</p>
            </div>
            <div class="mt-4">
                <p>
                    {{ __('Internal Code') }}: <span class="font-bold"> {{ $building->internal_code }} </span>
                </p>
                <p>
                    {{ __('Status') }}: <span class="font-bold"> {{ $building->status->name() }} </span>
                </p>
                <p>
                    {{ __('Construction Year') }}: <span class="font-bold"> {{ $building->construction_year }} </span>
                </p>
                <p>
                    {{ __('Square') }}: <span class="font-bold"> {{ $building->square }} </span>
                </p>
                <p>
                    {{ __('Floors') }}: <span class="font-bold"> {{ $building->floors }} </span>
                </p>
                <p>
                    {{ __('Apartments') }}: <span class="font-bold">{{ $building->apartments()->count() }} </span>
                </p>
                <p>
                    {{ __('Tenants') }}: <span class="font-bold"> {{ $building->tenantsSum() }} </span>
                </p>
                <p>
                    {{ __('Elevator') }}: <span class="font-bold"> {{ $building->getElevatorStatusText() }} </span>
                </p>
                <p>
                    {{ __('Yard') }}: <span class="font-bold"> {{ $building->getYardStatusText() }} </span>
                </p>
            </div>
        </div>
        <div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                <p class="text-lg font-semibold text-sky-600">{{ __('Administrative Info') }}</p>
            </div>
            <div class="mt-4">
                <p>
                    {{ __('PIB') }}: <span class="font-bold"> {{ $building->pib }} </span>
                </p>
                <p>
                    {{ __('Identification number') }}: <span class="font-bold"> {{ $building->identification_number }} </span>
                </p>
                <p>
                    {{ __('Account number') }}: <span class="font-bold"> {{ $building->account_number }} </span>
                </p>

            </div>
        </div>
        <div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <p class="text-lg font-semibold text-indigo-600">{{ __('Location') }}</p>
            </div>
            <div class="mt-4">
                <p>
                    {{ __('Address') }}: <span class="font-bold"> {{ $building->address }} </span>
                </p>
                <p>
                    {{ __('City') }}: <span class="font-bold"> {{ $building->city }} </span>
                </p>
                <p>
                    {{ __('County') }}: <span class="font-bold"> {{ $building->county }} </span>
                </p>
                <p>
                    {{ __('Postal Code') }}: <span class="font-bold"> {{ $building->postal_code }} </span>
                </p>
            </div>
        </div>
        <div>
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <p class="text-lg font-semibold text-yellow-600">{{ __('Balance') }}</p>
            </div>
            <div class="mt-4">
                <p>
                    {{ __('Current') }}: <span class="font-bold"> {{ $building->balance }} </span>
                </p>
                <p>
                    {{ __('Begining') }}: <span class="font-bold"> {{ $building->balance_begining }} </span>
                </p>
            </div>
        </div>
    </div>

    <div class="mt-24">
        <h2 class="text-xl font-semibold">{{ __('Apartments') }}</h2>

        <x-flash-message type="success" name="apratmentCreated" />
        
        <x-flash-message type="success" name="apratmentUpdated" />
        <x-flash-message type="error" name="apratmentNotUpdated" />
        
        <x-flash-message type="success" name="apratmentDeleted" />
        <x-flash-message type="error" name="apratmentNotDeleted" />

        <div class="flex items-center justify-end">
            <x-link-button route="{{ route('apartments.create', $building) }}" text="{{ __('New Apartment') }}" />
        </div>

            @livewire('apartments.apartments-table', ['building' => $building])
    </div>

    <div class="mt-12">
        <h2 class="text-xl font-semibold">{{ __('Notifications') }}</h2>

        @livewire('notifications.notifications-table-for-building', ['building' => $building])
    </div>
</x-app-layout>