<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Gerona Marketplace</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<h3>Hello <?php echo $user_fullname; ?></h3>
	<p>We received a request to reset your password for your Gerona Marketplace Account:<?php echo $user_name; ?>. We're here to help!<br>
	Simply click on the button to set a new password

	</p>
	<btn align="center" width="300" height="40" bgcolor="#3498db" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
		<a href="<?php echo $base; ?>ForgotPassword/transaction/checktoken?user_id=<?php echo $user_id; ?>&token=<?php echo $token_id; ?>" style="font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block"><span style="color: #FFFFFF">Set a New Password</span></a>
	</btn>
</body>
</html>
