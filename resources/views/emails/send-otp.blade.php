<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><p>Subject: {{ $mailData['subject'] }}</p></title>
</head>

<body>
    

    <p>Dear <b>{{ $mailData['name'] }}</b>,</p>

    <span style="display:block">We've received a request to reset the password for your NearMeHostel account. To proceed with the password reset,
        please use the following One-Time Password (OTP):</span>

    <span style="display:block">OTP: <b>{{ $mailData['otp'] }}</b>,</span>

    <span style="display:block">Please enter this OTP on the password reset page to complete the process. Ensure that you keep this OTP confidential
    and do not share it with anyone.</span>

    <span style="display:block">If you did not initiate this password reset request, please disregard this email. Your account security is important
    to us, and we advise you to review your account activity for any unauthorized access.</span>

    <span style="display:block">If you have any questions or concerns, please don't hesitate to contact our support team at {{ $mailData['email'] }} or call
    us at <a href="tel:{{ $mailData['mobile'] }}">{{ $mailData['mobile'] }}</a>.</span>

    <span style="display:block">Thank you for choosing NearMeHostel.</span>

    Best regards,

    <span style="display: block; font-weight:bold;">{{ $mailData['owner'] }}</span>
    <span style="display: block; font-weight:bold;">Founder</span>
    <span style="display: block; font-weight:bold;">{{ $mailData['site_name'] }}</span>
</body>

</html>
