@component('mail::message')
# Registrant: {{ $personalInformation->first_name . ' ' . $personalInformation->last_name }}
# Reference Code: {{ $personalInformation->reference_code }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
