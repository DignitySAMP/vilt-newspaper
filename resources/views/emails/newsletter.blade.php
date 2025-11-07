<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailSubject }}</title>
</head>

<body
    style="background-color:#f1f5f9; font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="border: 4px solid black; background-color: white; padding: 2rem;">
        <h2 style="color: #2c3e50; margin-bottom: 20px;">{{ $emailSubject }}</h2>

        <div style="background-color: white; margin-bottom: 20px;">
            <p style="margin-bottom: 20px;">{{ $emailContent }}</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $buttonUrl }}"
                    style="display: inline-block; padding: 12px 30px; background-color: black; color: white; text-decoration: none; text-transform:uppercase; font-weight: bold;">
                    {{ $buttonText }}
                </a>
            </div>
        </div>

        <p style="font-size: 12px; color: #666; text-align: center;">
            You received this email because you're subscribed to our newsletter.
        </p>
    </div>
</body>

</html>