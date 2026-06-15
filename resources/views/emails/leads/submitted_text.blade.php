{{ $brand ?? config('app.name') }} — New Enquiry
=========================================

Source : {{ $s->source ?? '-' }}
Type   : {{ strtoupper($s->form_type ?? '-') }}
Locale : {{ strtoupper($s->locale ?? '-') }}

CONTACT DETAILS
---------------
Name    : {{ $s->name ?? '-' }}
@if($s->company)Company : {{ $s->company }}
@endif
Phone   : {{ $s->phone ?? '-' }}
@if($s->email)Email   : {{ $s->email }}
@endif

@if($s->message)Message:
{{ $s->message }}

@endif

@php
    $details = $s->details ?? [];
    if (is_string($details)) {
        $decoded = json_decode($details, true);
        $details = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
    }
    if (!is_array($details)) $details = [];
    $refUrl = $details['ref'] ?? null;
    if (array_key_exists('ref', $details)) unset($details['ref']);
@endphp
@if(!empty($details))
ADDITIONAL DETAILS
------------------
@foreach($details as $key => $value)
{{ ucfirst(str_replace('_',' ', (string) $key)) }} : {{ is_array($value) ? json_encode($value) : $value }}
@endforeach

@endif
META
----
IP       : {{ $s->ip ?? '-' }}
Location : {{ trim(implode(', ', array_filter([$s->geo_city, $s->geo_region, $s->geo_country])) ?: '-') }}
@if($refUrl)Referrer : {{ $refUrl }}
@endif

Submission #{{ $s->id }}
{{ $s->created_at ?? now() }}
