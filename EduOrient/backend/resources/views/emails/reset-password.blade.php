<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation ProLink</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f5fb;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f4f5fb;padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:480px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 8px 32px rgba(67,24,255,0.08);">
                <tr>
                    <td style="padding:28px 32px 8px;text-align:center;background:linear-gradient(135deg,#4318FF 0%,#7c5cff 100%);">
                        <p style="margin:0;font-size:22px;font-weight:800;letter-spacing:-0.5px;color:#ffffff;">ProLink</p>
                        <p style="margin:8px 0 0;font-size:13px;color:rgba(255,255,255,0.9);">Réinitialisation du mot de passe</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:28px 32px 32px;">
                        <p style="margin:0 0 16px;font-size:15px;line-height:1.6;color:#2B3674;">
                            Bonjour <strong>{{ $userName }}</strong>,
                        </p>
                        <p style="margin:0 0 24px;font-size:14px;line-height:1.6;color:#5a6376;">
                            Utilisez le code ci-dessous pour définir un nouveau mot de passe. Il expire dans 15 minutes.
                        </p>
                        <div style="text-align:center;margin:24px 0;">
                            <span style="display:inline-block;padding:16px 28px;font-size:28px;font-weight:800;letter-spacing:8px;color:#4318FF;background:#f0edff;border-radius:12px;border:2px dashed #c4b5fd;">
                                {{ $plainCode }}
                            </span>
                        </div>
                        <p style="margin:24px 0 0;font-size:12px;line-height:1.5;color:#a3aed0;">
                            Si vous n’avez pas demandé cette réinitialisation, ignorez ce message : votre mot de passe restera inchangé.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
