@php
    /** Detail extraction — service-quick vs simple form */
    $details = $s->details ?? [];
    if (is_string($details)) {
        $decoded = json_decode($details, true);
        $details = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
    }
    if (! is_array($details)) $details = [];

    $treatmentLabel = $details['treatment_label']
        ?? $details['service_title']
        ?? null;
    $treatmentSlug  = $details['treatment_slug']
        ?? $details['service_slug']
        ?? null;
    $sourceForm     = $details['source_form'] ?? $s->form_type;
    $refUrl         = $details['ref']
        ?? (is_array($s->details ?? null) ? ($s->details['ref'] ?? null) : null);

    /** Phone formatting for tel: + display */
    $phoneRaw = preg_replace('/\D+/', '', $s->phone ?? '');
    $phoneTel = $s->phone ? trim($s->phone) : null;

    /** Timestamps */
    $createdAt = $s->created_at?->setTimezone('Europe/Istanbul')?->format('d.m.Y H:i') ?? now()->format('d.m.Y H:i');

    /** Brand colors */
    $C = [
        'brand'    => '#E63946',
        'brandDk'  => '#C42B37',
        'deep'     => '#0F3D5A',
        'deepMid'  => '#1E5F9E',
        'leaf'     => '#84CC16',
        'leafDk'   => '#5A8E0F',
        'bg'       => '#F4F6F9',
        'card'     => '#FFFFFF',
        'border'   => '#E5E7EB',
        'soft'     => '#F7F9FB',
        'ink900'   => '#0F1115',
        'ink700'   => '#374151',
        'ink500'   => '#6B7280',
        'ink300'   => '#9CA3AF',
    ];

    $brandName = $brand ?? (config('mail.from.name') ?? config('app.name'));
    $logoUrl   = rtrim(config('app.url'), '/') . '/img/logo.png';
@endphp
<!doctype html>
<html lang="{{ $s->locale ?? app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light only">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <title>{{ $subject ?? 'Yeni Randevu Talebi' }}</title>
    <style>
        @media only screen and (max-width: 620px) {
            .container { width: 100% !important; }
            .px-side { padding-left: 18px !important; padding-right: 18px !important; }
            .btn-stack { display: block !important; width: 100% !important; }
            .btn-stack td { display: block !important; width: 100% !important; }
            .btn-stack a { display: block !important; }
            .info-row td { display: block !important; width: 100% !important; padding-bottom: 10px !important; }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:{{ $C['bg'] }};font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;color:{{ $C['ink900'] }};-webkit-font-smoothing:antialiased;">

{{-- Preview text (inbox preview) --}}
<div style="display:none;font-size:1px;color:{{ $C['bg'] }};line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">
    {{ $s->name ?? 'Yeni randevu talebi' }} — {{ $phoneTel ?? 'iletişim talebi' }} {{ $treatmentLabel ? '· ' . $treatmentLabel : '' }}
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:{{ $C['bg'] }};padding:32px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" class="container"
                   style="width:600px;max-width:600px;background:{{ $C['card'] }};border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(15,61,90,0.06);">

                {{-- ====== TOP BRAND GRADIENT STRIP ====== --}}
                <tr>
                    <td style="height:4px;background:linear-gradient(to right, {{ $C['brand'] }}, {{ $C['leaf'] }}, {{ $C['deepMid'] }});font-size:0;line-height:0;">&nbsp;</td>
                </tr>

                {{-- ====== HEADER: Logo + Brand ====== --}}
                <tr>
                    <td class="px-side" style="padding:28px 32px 22px 32px;border-bottom:1px solid {{ $C['border'] }};background:{{ $C['card'] }};">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="left" valign="middle" style="vertical-align:middle;">
                                    <img src="{{ $logoUrl }}" alt="{{ $brandName }}" height="40" style="display:block;height:40px;width:auto;border:0;outline:none;">
                                </td>
                                <td align="right" valign="middle" style="vertical-align:middle;font-size:11px;color:{{ $C['ink500'] }};letter-spacing:0.18em;text-transform:uppercase;font-weight:700;">
                                    #{{ str_pad((string) $s->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ====== TITLE + KICKER ====== --}}
                <tr>
                    <td class="px-side" style="padding:30px 32px 8px 32px;">
                        <p style="margin:0 0 8px 0;font-size:11px;color:{{ $C['brand'] }};font-weight:700;letter-spacing:0.22em;text-transform:uppercase;">
                            Randevu Talebi
                        </p>
                        <h1 style="margin:0;font-size:22px;font-weight:700;color:{{ $C['deep'] }};line-height:1.25;letter-spacing:-0.01em;">
                            Yeni randevu talebi geldi
                        </h1>
                        <p style="margin:8px 0 0 0;font-size:14px;line-height:1.55;color:{{ $C['ink500'] }};font-weight:400;">
                            <strong style="color:{{ $C['ink900'] }};font-weight:600;">{{ $s->name ?? '—' }}</strong> sizinle iletişime geçmek istiyor. Detaylar aşağıda.
                        </p>
                    </td>
                </tr>

                {{-- ====== CONTACT CARD ====== --}}
                <tr>
                    <td class="px-side" style="padding:22px 32px 0 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background:{{ $C['soft'] }};border:1px solid {{ $C['border'] }};border-radius:12px;">
                            <tr>
                                <td style="padding:16px 18px;">
                                    <p style="margin:0 0 14px 0;font-size:10.5px;color:{{ $C['ink500'] }};font-weight:700;letter-spacing:0.18em;text-transform:uppercase;">
                                        İletişim Bilgileri
                                    </p>

                                    {{-- Ad Soyad --}}
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
                                        <tr>
                                            <td width="110" style="font-size:12.5px;color:{{ $C['ink500'] }};vertical-align:top;padding-top:1px;">Ad Soyad</td>
                                            <td style="font-size:14.5px;color:{{ $C['ink900'] }};font-weight:600;">{{ $s->name ?? '—' }}</td>
                                        </tr>
                                    </table>

                                    {{-- Telefon --}}
                                    @if($phoneTel)
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
                                        <tr>
                                            <td width="110" style="font-size:12.5px;color:{{ $C['ink500'] }};vertical-align:top;padding-top:1px;">Telefon</td>
                                            <td style="font-size:14.5px;color:{{ $C['deep'] }};font-weight:600;">
                                                <a href="tel:{{ $phoneTel }}" style="color:{{ $C['deep'] }};text-decoration:none;">{{ $phoneTel }}</a>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif

                                    {{-- E-posta --}}
                                    @if($s->email)
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:10px;">
                                        <tr>
                                            <td width="110" style="font-size:12.5px;color:{{ $C['ink500'] }};vertical-align:top;padding-top:1px;">E-posta</td>
                                            <td style="font-size:14.5px;color:{{ $C['brand'] }};font-weight:500;word-break:break-all;">
                                                <a href="mailto:{{ $s->email }}" style="color:{{ $C['brand'] }};text-decoration:none;">{{ $s->email }}</a>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif

                                    {{-- İlgilenilen Tedavi --}}
                                    @if($treatmentLabel)
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td width="110" style="font-size:12.5px;color:{{ $C['ink500'] }};vertical-align:top;padding-top:1px;">Tedavi</td>
                                            <td>
                                                <span style="display:inline-block;background:{{ $C['deep'] }};color:#FFFFFF;font-size:12.5px;font-weight:600;padding:5px 12px;border-radius:20px;letter-spacing:0.01em;">
                                                    {{ $treatmentLabel }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ====== MESSAGE (if provided) ====== --}}
                @if($s->message)
                <tr>
                    <td class="px-side" style="padding:16px 32px 0 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background:{{ $C['card'] }};border:1px solid {{ $C['border'] }};border-left:3px solid {{ $C['brand'] }};border-radius:8px;">
                            <tr>
                                <td style="padding:14px 18px;">
                                    <p style="margin:0 0 8px 0;font-size:10.5px;color:{{ $C['brand'] }};font-weight:700;letter-spacing:0.18em;text-transform:uppercase;">
                                        Mesaj
                                    </p>
                                    <p style="margin:0;font-size:14px;line-height:1.65;color:{{ $C['ink700'] }};white-space:pre-wrap;">{{ $s->message }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif

                {{-- ====== QUICK ACTIONS ====== --}}
                <tr>
                    <td class="px-side" style="padding:24px 32px 0 32px;">
                        <p style="margin:0 0 12px 0;font-size:10.5px;color:{{ $C['ink500'] }};font-weight:700;letter-spacing:0.18em;text-transform:uppercase;">
                            Hızlı Eylem
                        </p>
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="btn-stack">
                            <tr>
                                @if($phoneTel)
                                <td style="padding-right:8px;vertical-align:top;">
                                    <a href="tel:{{ $phoneTel }}"
                                       style="display:block;background:{{ $C['deep'] }};color:#FFFFFF;text-decoration:none;text-align:center;font-size:13px;font-weight:600;padding:12px 16px;border-radius:8px;letter-spacing:0.02em;">
                                        Telefonla Ara
                                    </a>
                                </td>
                                <td style="padding-right:8px;padding-left:0;vertical-align:top;">
                                    <a href="https://wa.me/{{ $phoneRaw }}" target="_blank"
                                       style="display:block;background:#1FA950;color:#FFFFFF;text-decoration:none;text-align:center;font-size:13px;font-weight:600;padding:12px 16px;border-radius:8px;letter-spacing:0.02em;">
                                        WhatsApp
                                    </a>
                                </td>
                                @endif
                                @if($s->email)
                                <td style="vertical-align:top;">
                                    <a href="mailto:{{ $s->email }}?subject=Re:%20Randevu%20Talebi"
                                       style="display:block;background:{{ $C['brand'] }};color:#FFFFFF;text-decoration:none;text-align:center;font-size:13px;font-weight:600;padding:12px 16px;border-radius:8px;letter-spacing:0.02em;">
                                        E-posta Yanıtla
                                    </a>
                                </td>
                                @endif
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ====== METADATA STRIP ====== --}}
                <tr>
                    <td class="px-side" style="padding:24px 32px 24px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="background:{{ $C['soft'] }};border:1px solid {{ $C['border'] }};border-radius:10px;">
                            <tr>
                                <td style="padding:14px 18px;font-size:12px;color:{{ $C['ink500'] }};line-height:1.65;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="info-row">
                                        <tr>
                                            <td width="50%" style="vertical-align:top;padding-right:8px;">
                                                <p style="margin:0 0 4px 0;font-size:10px;color:{{ $C['ink300'] }};font-weight:700;letter-spacing:0.16em;text-transform:uppercase;">Tarih</p>
                                                <p style="margin:0;font-size:12.5px;color:{{ $C['ink700'] }};font-weight:500;">{{ $createdAt }}</p>
                                            </td>
                                            <td width="50%" style="vertical-align:top;padding-left:8px;">
                                                <p style="margin:0 0 4px 0;font-size:10px;color:{{ $C['ink300'] }};font-weight:700;letter-spacing:0.16em;text-transform:uppercase;">Form Kaynağı</p>
                                                <p style="margin:0;font-size:12.5px;color:{{ $C['ink700'] }};font-weight:500;">{{ ucfirst($sourceForm ?? 'simple') }}{{ $s->source ? ' · ' . $s->source : '' }}</p>
                                            </td>
                                        </tr>
                                        <tr><td colspan="2" style="height:10px;line-height:10px;font-size:0;">&nbsp;</td></tr>
                                        <tr>
                                            <td style="vertical-align:top;padding-right:8px;">
                                                <p style="margin:0 0 4px 0;font-size:10px;color:{{ $C['ink300'] }};font-weight:700;letter-spacing:0.16em;text-transform:uppercase;">Konum</p>
                                                <p style="margin:0;font-size:12.5px;color:{{ $C['ink700'] }};font-weight:500;">
                                                    {{ trim(implode(', ', array_filter([$s->geo_city, $s->geo_region, $s->geo_country]))) ?: '—' }}
                                                </p>
                                            </td>
                                            <td style="vertical-align:top;padding-left:8px;">
                                                <p style="margin:0 0 4px 0;font-size:10px;color:{{ $C['ink300'] }};font-weight:700;letter-spacing:0.16em;text-transform:uppercase;">IP</p>
                                                <p style="margin:0;font-size:12.5px;color:{{ $C['ink700'] }};font-weight:500;">{{ $s->ip ?? '—' }}</p>
                                            </td>
                                        </tr>
                                        @if($refUrl)
                                        <tr><td colspan="2" style="height:10px;line-height:10px;font-size:0;">&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="2" style="vertical-align:top;">
                                                <p style="margin:0 0 4px 0;font-size:10px;color:{{ $C['ink300'] }};font-weight:700;letter-spacing:0.16em;text-transform:uppercase;">Referrer</p>
                                                <p style="margin:0;font-size:12.5px;color:{{ $C['ink700'] }};font-weight:500;word-break:break-all;">{{ $refUrl }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ====== FOOTER ====== --}}
                <tr>
                    <td style="padding:18px 32px;background:{{ $C['deep'] }};text-align:center;">
                        <p style="margin:0;font-size:11.5px;color:rgba(255,255,255,0.75);line-height:1.55;">
                            <strong style="color:#FFFFFF;">{{ $brandName }}</strong>
                            <span style="color:rgba(255,255,255,0.45);"> · </span>
                            Kalp ve Damar Cerrahisi Uzmanı
                        </p>
                        <p style="margin:6px 0 0 0;font-size:10.5px;color:rgba(255,255,255,0.55);letter-spacing:0.04em;">
                            Web sitenizdeki iletişim formundan gönderildi.
                        </p>
                    </td>
                </tr>
            </table>

            {{-- After-card timestamp --}}
            <p style="margin:14px 0 0 0;font-size:11px;color:{{ $C['ink300'] }};letter-spacing:0.04em;">
                Submission #{{ $s->id }} · {{ $createdAt }}
            </p>

        </td>
    </tr>
</table>
</body>
</html>
