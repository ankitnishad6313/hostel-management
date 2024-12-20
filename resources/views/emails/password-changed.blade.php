<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mailData['subject'] }}</title>
</head>

<body>
    <p>Dear <b>{{ $mailData['name'] }}</b>,</p>
    <p>
        This is to confirm that the password for your NearMeHostel account has been successfully changed.
    </p>
    <p>
        If you made this change, you may disregard this email. However, if you did not authorize this change or believe
        your account has been compromised, please contact our support team immediately at {{ $mailData['email'] }} or call us at
        {{ $mailData['mobile'] }}.
    </p>

    <p>
        Thank you for choosing NearMeHostel. We are committed to ensuring the security and privacy of your account.
    </p>
    Best regards,

    <span style="display: block; font-weight:bold;">{{ $mailData['owner'] }}</span>
    <span style="display: block; font-weight:bold;">Founder</span>
    <span style="display: block; font-weight:bold;">{{ $mailData['site_name'] }}</span>
</body>

</html>
