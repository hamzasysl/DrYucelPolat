@php
    $details = $s->details ?? [];
    if (is_string($details)) {
        $decoded = json_decode($details, true);
        $details = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
    }
    if (! is_array($details)) $details = [];

    $treatmentLabel = $details['treatment_label'] ?? $details['service_title'] ?? null;
    $sourceForm     = $details['source_form'] ?? $s->form_type;
    $refUrl         = $details['ref'] ?? null;
    $createdAt      = $s->created_at?->setTimezone('Europe/Istanbul')?->format('d.m.Y H:i') ?? now()->format('d.m.Y H:i');
    $brandName      = $brand ?? (config('mail.from.name') ?? config('app.name'));
@endphp
{{ $brandName }} — Yeni Randevu Talebi #{{ str_pad((string) $s->id, 5, '0', STR_PAD_LEFT) }}
=========================================================

Ad Soyad : {{ $s->name ?? '—' }}
Telefon  : {{ $s->phone ?? '—' }}
@if($s->email)
E-posta  : {{ $s->email }}
@endif
@if($treatmentLabel)
Tedavi   : {{ $treatmentLabel }}
@endif

@if($s->message)
--- MESAJ ---
{{ $s->message }}

@endif
--- METADATA ---
Tarih    : {{ $createdAt }}
Kaynak   : {{ ucfirst($sourceForm ?? 'simple') }}{{ $s->source ? ' / ' . $s->source : '' }}
Konum    : {{ trim(implode(', ', array_filter([$s->geo_city, $s->geo_region, $s->geo_country]))) ?: '—' }}
IP       : {{ $s->ip ?? '—' }}
@if($refUrl)
Referrer : {{ $refUrl }}
@endif

---
Web sitenizdeki iletişim formundan gönderildi.
{{ $brandName }} · Kalp ve Damar Cerrahisi Uzmanı
