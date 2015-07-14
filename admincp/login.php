<?php
	/**
	 * Virtual Chat 1.0.0
	 * Software by DesignSkate
	 */
	 
	include("../core/rc/config.inc.php");
	include("../core/ac.functions.php");
	include("../core/ac.sessions.php");
	
	if (isset($_SESSION["admin_session"]))
	{
		header('location: index.php');
		exit();
	}
	
	if (isset($_POST["password"]))
	{
		$password = trim($db->real_escape_string(sha1(str_rot13($_POST["password"] . $keys["enc_1"]))));
		
		if ($password == $GLOBALS["settings"]["admin_password"])
		{
			$_SESSION["admin_session"] = "m1";
			header('location: index.php');
		}
		else
		{
			header('location: login.php?e=1');
		}
	}
	else
	{
?> 
<!doctype html>
<html>
    <head>
	    <title>Virtual Chat Admin</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="template/style.css" />
		<style>
			#login_box {
				background:#ffffff;
				padding:20px;
				border-radius:4px;
				width:600px;
				margin:auto;
				margin-top:20px;
			}
			
			.ftitle {
				font-size:14px;
				border-bottom:1px solid #eaeaea;
				padding-bottom:10px;
				margin-bottom:10px;
			}
			
			input[type="password"] {
			  padding: 10px;
			  border: 1px solid #eaeaea;
			  border-bottom: solid 2px #c9c9c9;
			  transition: border 0.3s;
			  width:578px;
			  color:#808080;
			  font-family: 'Open Sans', sans-serif;
			}
			
			input[type="password"]:focus,
			input[type="password"].focus {
			  border-bottom: solid 2px #969696;
			}
		</style>
	</head>
<body>
	<div id="menu"></div>
	<div style="background:#ffffff; padding-top:20px; padding-bottom:20px; border-bottom:2px solid #c0c0c0;">
		<div style="width:640px; margin:auto;"><img src="../static/img/logo.png"></div>
	</div>
	<div id="login_box">
		<form action="login.php?login=true" method="post">
			<div class="ftitle">Admin Password</div>
			<div class="clear"></div>
			<input type="password" name="password" placeholder="Admin Password">
			<div class="clear"></div>
			<input type="submit" style="padding:10px; background:#eaeaea; border-radius:4px; border:0px; color:#808080; width:600px;" value="Login">
		</form>
	</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</html>
<?php } ?>