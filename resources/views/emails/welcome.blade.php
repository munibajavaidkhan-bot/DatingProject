<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background:#f9fafb;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#ec4899,#a855f7);padding:32px;text-align:center;">
                            <h1 style="color:white;margin:0;font-size:24px;">💕 Welcome to The Love Project</h1>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="color:#1f2937;margin:0 0 16px;">Hi {{ $user->name }}!</h2>
                            <p style="color:#6b7280;line-height:1.7;margin:0 0 20px;">
                                We're thrilled to have you join our community! The Love Project is more than just a dating platform — it's a 52-week journey to meaningful connections and self-discovery.
                            </p>
                            <p style="color:#6b7280;line-height:1.7;margin:0 0 24px;">
                                Here's what you can do next:
                            </p>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:12px 16px;background:#fdf2f8;border-radius:10px;margin-bottom:8px;">
                                        <strong style="color:#ec4899;">1.</strong> <span style="color:#374151;">Complete your profile to get better matches</span>
                                    </td>
                                </tr>
                                <tr><td style="height:8px;"></td></tr>
                                <tr>
                                    <td style="padding:12px 16px;background:#fdf2f8;border-radius:10px;">
                                        <strong style="color:#ec4899;">2.</strong> <span style="color:#374151;">Take the personality quiz for personalized matching</span>
                                    </td>
                                </tr>
                                <tr><td style="height:8px;"></td></tr>
                                <tr>
                                    <td style="padding:12px 16px;background:#fdf2f8;border-radius:10px;">
                                        <strong style="color:#ec4899;">3.</strong> <span style="color:#374151;">Start exploring and connecting with others</span>
                                    </td>
                                </tr>
                            </table>
                            <div style="text-align:center;margin:28px 0;">
                                <a href="{{ route('login') }}" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;border-radius:10px;font-weight:600;">
                                    Get Started →
                                </a>
                            </div>
                            <p style="color:#9ca3af;font-size:13px;line-height:1.6;margin:0;">
                                If you have any questions, feel free to reach out to us at 
                                <a href="mailto:Support@loveproject.us" style="color:#a855f7;">Support@loveproject.us</a>
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb;padding:20px 32px;text-align:center;">
                            <p style="color:#9ca3af;font-size:12px;margin:0;">
                                © {{ date('Y') }} The Love Project. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
