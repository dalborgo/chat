<?php
	/**
	 * Virtual Chat 1.0.0
	 * Software by DesignSkate
	 */
	 
	include("../core/rc/config.inc.php");
	include("../core/ac.functions.php");
	include("../core/ac.sessions.php");
	
	if (!isset($_SESSION["admin_session"]))
	{
		header('location: login.php');
		exit();
	}
	
	// Pages
	$home = ""; $rooms = ""; $users = ""; $games = ""; $settingsp = "";
	if (isset($_GET["page"]))
	{
		if ($_GET["page"] == "home")
		{
			$home = " class=\"active\"";
		}
		elseif ($_GET["page"] == "users")
		{
			$users = " class=\"active\"";
		}
		elseif ($_GET["page"] == "settings")
		{
			$settingsp = " class=\"active\"";
		}
	}
	else
	{
		$home = "class=\"active\"";
	}
?> 
<!doctype html>
<html>
    <head>
	    <title>Virtual Chat Admin</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="template/style.css" />
	</head>
<body>
	<div id="menu">
		<div class="wrap">
			<span style="float:left;">
				<a href="index.php?page=home"<?php echo $home; ?>>Admin Home</a>
				<a href="index.php?page=users"<?php echo $users; ?>>User Management</a>
				<a href="index.php?page=settings"<?php echo $settingsp; ?>>Website Settings</a>
			</span>
			<span style="float:right;">
				<a href="../index.php" target="_blank">Return to site</a>
				<a href="index.php?page=logout">Logout</a>
			</span>
		</div>
	</div>
	<div class="wrap">

		<?php 
			// Include admin panel pages
			if (isset($_GET["page"])):
				if ($_GET["page"] == "home"): include("pages/dashboard.php"); endif;
				if ($_GET["page"] == "settings"): include("pages/settings.php"); endif;
				if ($_GET["page"] == "users"): include("pages/users.php"); endif;
				if ($_GET["page"] == "logout"): include("pages/logout.php"); endif;
				
				/******
				* The following page should not be removed under any circumstances
				******/
				if ($_GET["page"] == "credits"): include("pages/credits.php"); endif;
				
			else:
				include("pages/dashboard.php");
			endif;
		?>		
		
	</div>
	<div class="wrap">
		<!--
			REMOVING THE FOLLOWING IS PROHIBITED.
			Virtual Chat's copyright notice must remain intact on the administration side of the system.
			This software (Virtual Chat) is property of DesignSkate.
		-->
		<div id="footer">
			<span style="float:left;">Powered by Virtual Chat version <?php echo $GLOBALS["config"]["ver_num"]; ?></span>
			<span style="float:right;"><a href="index.php?page=credits">Credits</a></span>
		</div>
	</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</html>