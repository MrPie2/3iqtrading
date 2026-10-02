<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light">
    <title>{{ $subject }}</title>
</head>
<body style="margin:0;padding:0;background:#eef4fb;font-family:Arial,Helvetica,sans-serif;color:#15243d;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#eef4fb;">
<tr><td align="center" style="padding:28px 10px;">
<table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 8px 30px rgba(24,60,110,.10);">

    <!-- Single compact header + financial hero -->
    <tr>
        <td style="background:#0b2854;padding:26px 30px 30px;">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td>
                        <div style="font-size:24px;line-height:1;font-weight:800;color:#ffffff;">3IQ<span style="color:#4da3ff;">TRADING</span></div>
                        <div style="margin-top:7px;font-size:10px;letter-spacing:1.8px;text-transform:uppercase;color:#a9c8ee;">INVEST • GROW • ACHIEVE</div>
                    </td>
                    <td align="right"><div style="display:inline-block;padding:6px 9px;border:1px solid #31527f;border-radius:18px;color:#cfe2ff;font-size:9px;">SECURE</div></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:25px;">
                        <div style="font-size:10px;letter-spacing:1.7px;text-transform:uppercase;color:#8fc3ff;font-weight:700;">INVESTMENT UPDATE</div>
                        <div style="font-size:26px;line-height:1.25;font-weight:800;color:#ffffff;margin-top:6px;">{{ $subject }}</div>
                        <div style="font-size:13px;line-height:1.6;color:#c9ddf8;margin-top:9px;">A new update has been prepared for your 3IQTrading account.</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top:20px;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#123f7d;border:1px solid #285992;border-radius:14px;">
                            <tr><td style="padding:17px 19px;">
                                <div style="font-size:10px;color:#91c7ff;letter-spacing:1.2px;text-transform:uppercase;">Portfolio momentum</div>
                                <div style="height:7px;background:#285992;border-radius:10px;margin-top:14px;"><div style="width:78%;height:7px;background:#51b6ff;border-radius:10px;"></div></div>
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:10px;"><tr>
                                    <td style="font-size:9px;color:#a9c8ee;">MARKET ACTIVITY</td><td align="right" style="font-size:9px;color:#a9c8ee;">GROWTH TRACK</td>
                                </tr></table>
                            </td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Main content -->
    <tr>
        <td style="padding:30px;">
            <p style="font-size:15px;line-height:1.7;color:#33445d;margin:0 0 7px;">
                Hello <strong style="color:#102b55;">{{ $recipientName }}</strong>,
            </p>

            <p style="font-size:14px;line-height:1.75;color:#64748b;margin:0 0 22px;">
                Your investment communication is shown below. Please review the details carefully and use your dashboard for your latest account information.
            </p>

            <!-- Account snapshot -->
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-radius:14px;background:#f5f9ff;border:1px solid #dce9f8;">
                <tr><td style="padding:17px 20px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                        <td width="50%"><div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">Status</div><div style="font-size:12px;color:#16804a;font-weight:700;margin-top:4px;">READY</div></td>
                        <td width="50%"><div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">Reference</div><div style="font-size:12px;color:#263a57;font-weight:700;margin-top:4px;">{{ $reference }}</div></td>
                    </tr></table>
                </td></tr>
            </table>

            @if(!empty($transactionType))
            <!-- Transaction details -->
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:27px;border-radius:14px;background:#f5f9ff;border:1px solid #dce9f8;">
                <tr><td style="padding:18px 20px;">
                    <div style="font-size:10px;letter-spacing:1.3px;text-transform:uppercase;color:#6d7d93;font-weight:700;margin-bottom:13px;">Transaction details</div>
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
                        <td width="50%"><div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">Transaction</div><div style="font-size:13px;color:#263a57;font-weight:700;margin-top:4px;">{{ $transactionType }}</div></td>
                        <td width="50%" align="right"><div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">Amount</div><div style="font-size:16px;color:#1769d1;font-weight:800;margin-top:4px;">{{ $transactionCurrency }} {{ number_format((float) $transactionAmount, 2) }}</div></td>
                    </tr><tr>
                        <td colspan="2" style="padding-top:14px;border-top:1px solid #e2eaf4;"><div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">Updated balance</div><div style="font-size:13px;color:#263a57;font-weight:700;margin-top:4px;">{{ $transactionCurrency }} {{ number_format((float) $transactionBalance, 2) }}</div></td>
                    </tr></table>
                </td></tr>
            </table>
            @endif

            <!-- Message -->
            <div style="margin-top:27px;padding:20px;border-left:4px solid #287de0;background:#f8fafc;border-radius:0 10px 10px 0;">
                <div style="font-size:10px;letter-spacing:1.4px;text-transform:uppercase;color:#6d7d93;font-weight:700;margin-bottom:9px;">
                    Message from 3IQTrading
                </div>
                <div style="font-size:14px;line-height:1.8;color:#46566e;white-space:pre-line;">
                    {{ $body }}
                </div>
            </div>

            <!-- CTA -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin-top:27px;">
                <tr>
                    <td style="border-radius:8px;background:#1769d1;">
                        <a href="{{ $dashboardUrl }}" style="display:inline-block;padding:13px 23px;color:#ffffff;text-decoration:none;font-size:13px;font-weight:700;">
                            View My Investment Dashboard &nbsp;→
                        </a>
                    </td>
                </tr>
            </table>

            <p style="font-size:12px;line-height:1.7;color:#8995a7;margin:24px 0 0;">
                For your security, never share your password, verification codes, or account credentials by email.
            </p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background:#f6f8fc;border-top:1px solid #e6ebf3;padding:22px 30px;text-align:center;">
            <div style="font-size:14px;font-weight:800;color:#17345f;">3IQ<span style="color:#2779d5;">TRADING</span></div>
            <div style="font-size:11px;line-height:1.7;color:#8a96a8;margin-top:7px;">
                Secure investor communication<br>
                &copy; {{ date('Y') }} 3IQTrading. All rights reserved.
            </div>
        </td>
    </tr>
</table>
</td></tr>
</table>
</body>
</html>
