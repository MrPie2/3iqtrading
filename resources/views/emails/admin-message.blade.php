<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ $subject }}</title>
</head>
<body style="margin:0;padding:0;background:#f3f6fb;font-family:Arial,Helvetica,sans-serif;color:#172033;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f3f6fb;padding:32px 12px;">
        <tr><td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:14px;overflow:hidden;">
                <tr><td style="background:#1746a2;padding:26px 32px;">
                    <div style="font-size:22px;line-height:1.2;font-weight:700;letter-spacing:.2px;color:#ffffff;">3IQ<span style="color:#8fb7ff;">TRADING</span></div>
                    <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#d7e5ff;margin-top:7px;">Investor communication</div>
                </td></tr>
                <tr><td style="padding:34px 32px 28px;">
                    <div style="font-size:20px;line-height:1.35;font-weight:700;color:#172033;margin:0 0 18px;">{{ $subject }}</div>
                    <p style="font-size:15px;line-height:1.7;color:#46536a;margin:0 0 14px;">Hello,</p>
                    <div style="font-size:15px;line-height:1.8;color:#46536a;white-space:pre-line;">{{ $body }}</div>
                    <p style="font-size:15px;line-height:1.7;color:#46536a;margin:24px 0 0;">Regards,<br><strong style="color:#172033;">3IQ Trading Support</strong></p>
                </td></tr>
                <tr><td style="padding:18px 32px;background:#f8faff;border-top:1px solid #e8edf5;">
                    <p style="font-size:11px;line-height:1.6;color:#8792a5;margin:0;">This message was sent by the 3IQ Trading team. If you need assistance, please contact our support team through the official website.</p>
                    <p style="font-size:11px;color:#a0a9b8;margin:10px 0 0;">&copy; {{ date('Y') }} 3IQ Trading. All rights reserved.</p>
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
