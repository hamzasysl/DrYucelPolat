<!doctype html>
<html lang="{{ $s->locale ?? app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $s->source ?? config('app.name') }}</title>
</head>

<body style="margin:0;padding:0;background:#f6f7fb;font-family:Arial,Helvetica,sans-serif;color:#0F1115;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f6f7fb;padding:24px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                   style="width:600px;max-width:600px;background:#ffffff;border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;">

                {{-- HEADER --}}
                <tr>
                    <td style="padding:22px 24px;border-bottom:1px solid #e5e7eb;background:#ffffff;">
                        <div style="font-size:16px;font-weight:700;color:#0F1115;">
                            {{ $brand ?? (config('mail.from.name') ?? config('app.name')) }}
                        </div>
                        <div style="margin-top:6px;font-size:13px;color:#7D8186;">
                            {{ $s->source ?? config('app.name') }}
                        </div>
                        <div style="margin-top:10px;height:2px;width:60px;background:#E0463A;"></div>
                    </td>
                </tr>

                {{-- BODY --}}
                <tr>
                    <td style="padding:22px 24px;">

                        <div style="font-size:18px;font-weight:700;margin-bottom:14px;color:#0F1115;">
                            New enquiry received
                        </div>

                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td style="padding:10px 12px;border:1px solid #e5e7eb;border-radius:12px;background:#fafafa;font-size:12px;color:#7D8186;">
                                    <strong style="color:#0F1115;">Type:</strong> {{ strtoupper($s->form_type ?? '-') }} &nbsp;•&nbsp;
                                    <strong style="color:#0F1115;">Locale:</strong> <span style="text-transform:uppercase;">{{ $s->locale ?? '-' }}</span>
                                </td>
                            </tr>
                        </table>

                        <div style="height:14px;"></div>

                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="border:1px solid #e5e7eb;border-radius:12px;">
                            <tr>
                                <td style="padding:14px 16px;">
                                    <div style="font-size:11px;color:#7D8186;font-weight:700;text-transform:uppercase;letter-spacing:.18em;margin-bottom:10px;">
                                        Contact details
                                    </div>

                                    <div style="font-size:14px;line-height:1.7;color:#0F1115;">
                                        <strong>Name:</strong> {{ $s->name ?? '-' }}<br>
                                        @if($s->company)<strong>Company:</strong> {{ $s->company }}<br>@endif
                                        <strong>Phone:</strong> {{ $s->phone ?? '-' }}<br>
                                        @if($s->email)<strong>Email:</strong> <a href="mailto:{{ $s->email }}" style="color:#E0463A;text-decoration:none;">{{ $s->email }}</a><br>@endif

                                        @if($s->message)
                                            <strong>Message:</strong><br>
                                            <span style="display:block;margin-top:4px;color:#3A3F47;">{{ $s->message }}</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>

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
                            <div style="height:14px;"></div>
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                   style="border:1px solid #e5e7eb;border-radius:12px;">
                                <tr>
                                    <td style="padding:14px 16px;font-size:14px;line-height:1.7;color:#0F1115;">
                                        <div style="font-size:11px;color:#7D8186;font-weight:700;text-transform:uppercase;letter-spacing:.18em;margin-bottom:10px;">
                                            Additional details
                                        </div>
                                        @foreach($details as $key => $value)
                                            <strong>{{ ucfirst(str_replace('_',' ', (string) $key)) }}:</strong>
                                            {{ is_array($value) ? json_encode($value) : $value }}<br>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        @endif

                        <div style="height:14px;"></div>

                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                               style="border:1px solid #e5e7eb;border-radius:12px;background:#fafafa;">
                            <tr>
                                <td style="padding:12px 16px;font-size:12px;color:#7D8186;line-height:1.6;">
                                    <strong style="color:#0F1115;">IP:</strong> {{ $s->ip ?? '-' }} &nbsp;•&nbsp;
                                    <strong style="color:#0F1115;">Location:</strong>
                                    {{ trim(implode(', ', array_filter([$s->geo_city, $s->geo_region, $s->geo_country])) ?: '-') }}
                                    @if(!empty($refUrl))
                                        <br><strong style="color:#0F1115;">Ref:</strong> {{ $refUrl }}
                                    @endif
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="padding:14px 24px;border-top:1px solid #e5e7eb;background:#fafafa;font-size:11px;color:#7D8186;text-align:center;">
                        Submission #{{ $s->id }} · {{ $s->created_at ?? now() }}
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
