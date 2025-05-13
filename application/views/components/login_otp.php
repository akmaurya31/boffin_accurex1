<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $subject;?> OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">
  <table width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
    <tr>
      <td align="center">
        <img src="<?php echo base_url('assets/images/logo.png');?>" alt="Accurex Accounting Logo" style="max-width: 150px; margin-bottom: 20px;">
      </td>
    </tr>
    <tr>
      <td>
        <h2 style="text-align: center; color: #333;">Your One-Time Password (OTP)</h2>
        <p style="font-size: 16px; color: #333;">Dear <strong><?php echo $username;?></strong>,</p>
        <p style="font-size: 16px; color: #333;">Use the following One-Time Password (OTP) to proceed with your action. This OTP is valid for the next 30 minutes only.</p>

        <div style="text-align: center; margin: 30px 0;">
          <span style="display: inline-block; font-size: 24px; background-color: #f2f2f2; padding: 15px 30px; border-radius: 8px; letter-spacing: 5px; font-weight: bold; color: #333;">
            <?php echo $otp;?>
          </span>
        </div>

        <p style="font-size: 16px; color: #333;">If you did not request this OTP, please ignore this email or contact our support team.</p>
        <p style="font-size: 16px; color: #333;">Thank you,<br><strong>Accurex Accounting</strong><br>
          <a href="mailto:contact@accurexaccounting.com" style="color: #0066cc;">contact@accurexaccounting.com</a><br>
          <a href="https://accurexaccounting.com/" style="color: #0066cc;">https://accurexaccounting.com/</a>
        </p>
      </td>
    </tr>
  </table>
</body>
</html>
