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

	

	<div id="button" style="width:200px;height:50px;border-radius:10px;background-color:#2980b9;color:#ecf0f1;font-size:14pt;"><center><a href="<?php echo $base; ?>ForgotPassword/transaction/checktoken?user_id=<?php echo $user_id; ?>&token=<?php echo $token_id; ?>" target="_blank"><font color="#ecf0f1">Set a New Password</font></a></center></div>
</body>
</html>
