<form>
    <x-form.input 
        type="text" 
        name="internal_code" 
        id="internal_code" 
        title="{{ __('Internal Code') }}" 
        placeholder="{{ __('Internal Code') }}" 
    />

    <x-form.select 
        name="status" 
        id="status" 
        title="{{ __('Status') }}" 
        :options="[
            'Active' => \App\Models\Building::STATUS_ACTIVE, 
            'Inactive' => \App\Models\Building::STATUS_INACTIVE
        ]"
    />
</form>