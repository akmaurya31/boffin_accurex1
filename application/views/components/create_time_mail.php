<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $subject; ?> - Job Added Successfully</title>
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
        <h2 style="text-align: center; color: #333;">New Job Added Successfully</h2>
        <p style="font-size: 16px; color: #333;">Dear <strong><?php echo $username;?></strong>,</p>
        <p style="font-size: 16px; color: #333;">We are pleased to inform you that a new job has been added to your account. Below are the job details:</p>

        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin: 20px 0; color: #333;">
          <p style="margin: 8px 0;"><strong>Job Code:</strong> <?php echo $jobcode?></p>
          <p style="margin: 8px 0;"><strong>Job Name:</strong> target-PTR-05-04-2024(MM)</p>
          <p style="margin: 8px 0;"><strong>Received On:</strong> 09/05/2025</p>
          <p style="margin: 8px 0;"><strong>Job Comments:</strong> testing</p>
        </div>

        <p style="font-size: 16px; color: #333;">If you have any questions or need further assistance, feel free to reach out to our support team.</p>
        <p style="font-size: 16px; color: #333;">Thank you,<br><strong>Accurex Accounting</strong><br>
          <a href="mailto:contact@accurexaccounting.com" style="color: #0066cc;">contact@accurexaccounting.com</a><br>
          <a href="https://accurexaccounting.com/" style="color: #0066cc;">https://accurexaccounting.com/</a>
        </p>
      </td>
    </tr>
  </table>
</body>
</html>
