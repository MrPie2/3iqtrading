<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light">
    <title>Verify your 3IQTrading account</title>
</head>
<body style="margin:0;padding:0;background:#eef4fb;font-family:Arial,Helvetica,sans-serif;color:#15243d;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#eef4fb;">
<tr><td align="center" style="padding:28px 10px;">
<table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 8px 30px rgba(24,60,110,.10);">

    <tr>
        <td style="background:#0b2854;padding:28px 30px;">
            <div style="font-size:24px;line-height:1;font-weight:800;color:#ffffff;">
                3IQ<span style="color:#4da3ff;">TRADING</span>
            </div>
            <div style="margin-top:7px;font-size:10px;letter-spacing:1.8px;text-transform:uppercase;color:#a9c8ee;">
                INVEST • GROW • ACHIEVE
            </div>
        </td>
    </tr>

    <tr>
        <td style="padding:36px 30px 32px;">
            <div style="font-size:10px;letter-spacing:1.7px;text-transform:uppercase;color:#287de0;font-weight:700;">
                ACCOUNT ACTIVATION
            </div>

            <h1 style="font-size:28px;line-height:1.25;color:#102b55;margin:8px 0 14px;">
                Verify your email address
            </h1>

            <p style="font-size:15px;line-height:1.75;color:#46566e;margin:0 0 8px;">
                Hello <strong style="color:#102b55;">{{ $recipientName }}</strong>,
            </p>

            <p style="font-size:14px;line-height:1.8;color:#64748b;margin:0 0 26px;">
                Your 3IQTrading account has been created. Click the button below to verify your email address and activate your account.
            </p>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 27px;">
                <tr>
                    <td style="border-radius:9px;background:#1769d1;">
                        <a href="{{ $verificationUrl }}" style="display:inline-block;padding:15px 27px;color:#ffffff;text-decoration:none;font-size:14px;font-weight:700;">
                            Verify My Account &nbsp;→
                        </a>
                    </td>
                </tr>
            </table>

            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-radius:14px;background:#f5f9ff;border:1px solid #dce9f8;">
                <tr><td style="padding:17px 20px;">
                    <div style="font-size:9px;color:#8a97aa;text-transform:uppercase;letter-spacing:.8px;">
                        Verification reference
                    </div>
                    <div style="font-size:12px;color:#263a57;font-weight:700;margin-top:4px;">
                        {{ $reference }}
                    </div>
                </td></tr>
            </table>

            <p style="font-size:12px;line-height:1.7;color:#8995a7;margin:24px 0 0;">
                This verification link is valid for 24 hours. If the button does not work, copy and paste the link below into your browser:
            </p>

            <p style="font-size:12px;line-height:1.7;word-break:break-all;margin:8px 0 0;">
                <a href="{{ $verificationUrl }}" style="color:#1769d1;text-decoration:underline;">{{ $verificationUrl }}</a>
            </p>

            <p style="font-size:12px;line-height:1.7;color:#8995a7;margin:24px 0 0;">
                For your security, never share your password or verification link with anyone.
            </p>
        </td>
    </tr>

    <tr>
        <td style="background:#f6f8fc;border-top:1px solid #e6ebf3;padding:22px 30px;text-align:center;">
            <div style="font-size:14px;font-weight:800;color:#17345f;">
                3IQ<span style="color:#2779d5;">TRADING</span>
            </div>
            <div style="font-size:11px;line-height:1.7;color:#8a96a8;margin-top:7px;">
                Secure account communication<br>
                &copy; {{ date('Y') }} 3IQTrading. All rights reserved.
            </div>
        </td>
    </tr>

</table>
</td></tr>
</table>
</body>
</html>
