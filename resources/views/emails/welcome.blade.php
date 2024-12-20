<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mailData['subject'] }}</title>
</head>

<body>
    <h2>{{ $mailData['title'] }}</h2>
    <h2>{{ $mailData['subject'] }}</h2>

    <p>Dear <b>{{ $mailData['name'] }}</b></p>,

    <p>On behalf of the entire team at NearMeHostel, I am thrilled to welcome you aboard! We're excited to have you join
        our community of travelers and adventurers.</p>

    <p>At NearMeHostel, we're dedicated to providing you with a comfortable and memorable experience during your stay.
        Whether you're here for business, leisure, or exploration, we're committed to ensuring that your time with us is
        nothing short of exceptional.</p>

    {{-- As a new member of our community, you'll have access to our top-notch amenities, including [mention any specific
    amenities or services]. Our team is here to assist you with any questions or concerns you may have, so please don't
    hesitate to reach out.

    To help you get started, here are a few things you might find useful:

    1. Check-in Information: [Include details about the check-in process, such as location, timing, and any necessary
    documentation.]

    2. Facility Information: [Provide an overview of the facilities available at the hostel, such as common areas,
    dining options, etc.]

    3. Nearby Attractions: [Highlight some popular attractions or points of interest near the hostel that guests often
    enjoy visiting.]

    4. Contact Information: [Provide contact details for the hostel, including phone number and email, for any
    assistance needed during your stay.] --}}

    <p> We want your experience at NearMeHostel to be nothing short of amazing, so please don't hesitate to let us know
        how
        we can make your stay more enjoyable.</p>

    <p>Once again, welcome to NearMeHostel! We look forward to being a part of your journey and creating wonderful
        memories
        together.</p>

    <span style="display: block;">Warm regards,</span>

    <span style="display: block; font-weight:bold;">Sandeep Kumar</span>
    <span style="display: block; font-weight:bold;">Founder</span>
    <span style="display: block; font-weight:bold;">NearMeHostel</span>
</body>

</html>
