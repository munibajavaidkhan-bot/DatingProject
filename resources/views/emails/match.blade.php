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
                    <tr>
                        <td style="background:linear-gradient(135deg,#ec4899,#a855f7);padding:32px;text-align:center;">
                            <h1 style="color:white;margin:0;font-size:24px;">🎉 It's a Match!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;text-align:center;">
                            <h2 style="color:#1f2937;margin:0 0 16px;">You matched with {{ $matchedUser->name }}!</h2>
                            <p style="color:#6b7280;line-height:1.7;margin:0 0 24px;">
                                Great news! You and {{ $matchedUser->name }} have liked each other. Start a conversation and get to know them better!
                            </p>
                            <div style="display:inline-block;padding:16px 24px;background:#fdf2f8;border-radius:12px;margin-bottom:24px;">
                                <p style="color:#ec4899;font-size:14px;font-weight:600;margin:0;">
                                    Compatibility Score: {{ $match->compatibility_score ?? 0 }}%
                                </p>
                            </div>
                            <br>
                            <a href="{{ route('member.chat.show', $match->id) }}" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;border-radius:10px;font-weight:600;">
                                Send a Message →
                            </a>
                        </td>
                    </tr>
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
