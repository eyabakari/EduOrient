<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau contact — ProLink</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f5fb;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f4f5fb;padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 32px rgba(67,24,255,0.08);">
                <tr>
                    <td style="padding:28px 32px 8px;text-align:center;background:linear-gradient(135deg,#4318FF 0%,#7c5cff 100%);">
                        <p style="margin:0;font-size:22px;font-weight:800;letter-spacing:-0.5px;color:#ffffff;">ProLink</p>
                        <p style="margin:8px 0 0;font-size:13px;color:rgba(255,255,255,0.9);">Nouveau message depuis le formulaire de contact</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:28px 32px 32px;">
                        <p style="margin:0 0 8px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#a3aed0;">Expéditeur</p>
                        <p style="margin:0 0 24px;font-size:15px;line-height:1.6;color:#2B3674;">
                            <a href="mailto:{{ $contact->email }}" style="color:#4318FF;text-decoration:none;font-weight:600;">{{ $contact->email }}</a>
                        </p>
                        <p style="margin:0 0 8px;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#a3aed0;">Message</p>
                        <div style="margin:0;padding:16px 18px;background:#f8f9fc;border-radius:12px;border:1px solid #e9edf7;">
                            <p style="margin:0;font-size:14px;line-height:1.65;color:#5a6376;white-space:pre-wrap;">{{ $contact->message }}</p>
                        </div>
                        <p style="margin:24px 0 0;font-size:12px;line-height:1.5;color:#a3aed0;">
                            Réf. en base : #{{ $contact->id }} — statut : {{ $contact->status }}
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
