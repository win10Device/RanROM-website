<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Verify Your Account</title>
    <style>
      /* Email styles */
      body {
        background-color: #f6f6f6;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.6em;
        margin: 0;
        padding: 0;
      }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%;
	padding-left: 20%;
	padding-right: 20%;
      }

      table td {
        font-size: 14px;
        vertical-align: top;
      }

      /* Email header */
      .email-header {
        background-color: #00b8e6;
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        padding: 20px;
        text-align: center;
      }

      /* Email body */
      .email-body {
        background-color: #fff;
        padding: 20px;
      }

      .button_1 {
        background-color: #00b8e6;
        border-radius: 3px;
        color: #fff;
        display: inline-block;
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
        padding: 10px 20px;
        text-decoration: none;
      }

      /* Email footer */
      .email-footer {
        background-color: #333;
        color: #fff;
        font-size: 12px;
        padding: 10px;
        text-align: center;
      }

      .email-footer p {
        margin: 0;
      }
    </style>
  </head>
  <body>
    <table style="max-width: 600px; border-collapse: collapse; border: 100px none; border-spacing: 0px; text-align: left;" align="center">
      <tr>
        <td>
          <div class="email-header">
            <!-- img src="" alt="My Logo" -->
            Verify Your Account
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="email-body">
            <p>Dear User,</p>
            <p>Thank you for signing up for our service. To ensure the security of your account, please click the button below to verify your email address:</p>
            <a href="{{ url }}" class="button_1">Verify Now</a>
            <p>If you did not create an account with us, please ignore this email.</p>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="email-footer">
            <p>This email was sent from an unmonitored email address. Please do not reply to this email.</p>
          </div>
        </td>
      </tr>
    </table>
  </body>
</html>

