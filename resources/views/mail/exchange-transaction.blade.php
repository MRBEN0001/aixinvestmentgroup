<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['subject'] ?? 'AIX Exchange Notification' }}</title>
</head>
<body style="margin:0;padding:0;background:#0b0f14;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#0b0f14;padding:32px 12px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background:#121821;border:1px solid rgba(176,131,97,0.35);border-radius:16px;overflow:hidden;">
                    <tr>
                        <td style="padding:28px 28px 12px;text-align:center;">
                            <div style="color:#c9aa79;font-size:22px;font-weight:700;letter-spacing:1px;">AIX EXCHANGE</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 28px 0;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;">{{ $data['title'] ?? 'Transaction Update' }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 28px;color:#94a3b8;font-size:15px;line-height:1.6;">
                            <p style="margin:0 0 16px;color:#f8fafc;">Hello {{ $data['name'] ?? 'Trader' }},</p>
                            <p style="margin:0 0 16px;">{{ $data['message'] ?? 'You have a new exchange transaction.' }}</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:12px;margin:18px 0;">
                                <tr>
                                    <td style="padding:14px 16px;color:#94a3b8;font-size:13px;text-transform:uppercase;">Type</td>
                                    <td style="padding:14px 16px;color:#ffffff;font-size:14px;text-align:right;font-weight:700;">{{ strtoupper($data['type'] ?? 'transaction') }}</td>
                                </tr>
                                @if (!empty($data['amount_label']))
                                <tr>
                                    <td style="padding:14px 16px;color:#94a3b8;font-size:13px;text-transform:uppercase;border-top:1px solid rgba(255,255,255,0.06);">Amount</td>
                                    <td style="padding:14px 16px;color:#ffffff;font-size:14px;text-align:right;font-weight:700;border-top:1px solid rgba(255,255,255,0.06);">{{ $data['amount_label'] }}</td>
                                </tr>
                                @endif
                                @if (!empty($data['status']))
                                <tr>
                                    <td style="padding:14px 16px;color:#94a3b8;font-size:13px;text-transform:uppercase;border-top:1px solid rgba(255,255,255,0.06);">Status</td>
                                    <td style="padding:14px 16px;color:#c9aa79;font-size:14px;text-align:right;font-weight:700;border-top:1px solid rgba(255,255,255,0.06);">{{ ucfirst($data['status']) }}</td>
                                </tr>
                                @endif
                                @if (!empty($data['reference']))
                                <tr>
                                    <td style="padding:14px 16px;color:#94a3b8;font-size:13px;text-transform:uppercase;border-top:1px solid rgba(255,255,255,0.06);">{{ $data['reference_label'] ?? 'Reference' }}</td>
                                    <td style="padding:14px 16px;color:#ffffff;font-size:13px;text-align:right;border-top:1px solid rgba(255,255,255,0.06);word-break:break-all;">{{ $data['reference'] }}</td>
                                </tr>
                                @endif
                                @if (!empty($data['details']))
                                <tr>
                                    <td colspan="2" style="padding:14px 16px;color:#94a3b8;font-size:13px;border-top:1px solid rgba(255,255,255,0.06);">
                                        {{ $data['details'] }}
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <p style="margin:0 0 8px;">You can review this activity anytime in your AIX Exchange Transactions page.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;text-align:center;">
                            <a href="{{ url('/exchange/transactions') }}" style="display:inline-block;background:linear-gradient(135deg,#b08361,#8f6648);color:#ffffff;text-decoration:none;font-weight:700;padding:12px 22px;border-radius:10px;text-transform:uppercase;font-size:13px;">
                                View Transactions
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;color:#64748b;font-size:12px;text-align:center;">
                            Sent by AIX Exchange · {{ config('exchange.mail.from.address', 'noreply@aixexchange.top') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
