<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Inquiry</title>
</head>
<body style="margin:0; padding:0; font-family: 'Inter', sans-serif; background-color:#1C1C1C; color:#fff;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #3C2A21, #1C1C1C); min-height:100vh; padding:40px 0;">
        <tr>
            <td align="center">
                <!-- Card Container -->
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#000000CC; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.5); padding:30px;">
                    <tr>
                        <td style="text-align:center; padding-bottom:20px;">
                            <h2 style="color:#C45B3A; font-size:28px; margin:0;">New Inquiry Received</h2>
                        </td>
                    </tr>

                    <!-- Name Card -->
                    <tr>
                        <td style="background-color:#1C1C1C; border-radius:12px; padding:15px; margin-bottom:15px;">
                            <p style="margin:0; font-weight:500; color:#AAAAAA;">From:</p>
                            <p style="margin:5px 0 0 0; font-weight:bold; font-size:18px; color:#FFFFFF;">{{ $name }}</p>
                        </td>
                    </tr>

                    <!-- Message Card -->
                    <tr>
                        <td style="background-color:#1C1C1C; border-radius:12px; padding:15px;">
                            <p style="margin:0; font-weight:500; color:#AAAAAA;">Message:</p>
                            <p style="margin:5px 0 0 0; font-weight:normal; font-size:16px; color:#FFFFFF; line-height:1.5;">{{ $user_message }}</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:30px; text-align:center; font-size:12px; color:#AAAAAA;">
                            <p style="margin:0;">This message was sent via Hotel Bookie Contact Form.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>