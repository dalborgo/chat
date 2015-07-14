<?php
	/**
	 * Virtual Chat 1.0.0 release
	 * Software by DesignSkate
	 */
	 
	if (!isset($_SESSION["admin_session"]))
	{
		header('location: login.php');
		exit();
	}
	
	if (isset($_GET["success"]) && $_GET["success"] == 1)
	{
		$success = "<div class=\"success_head\">Settings updated.</div>";
	}
	else
	{
		$success = "";
	}
	
	if (isset($_GET["error"]) && $_GET["error"] == 1)
	{
		$error = "<div class=\"error_head\">Fields should not be blank.</div>";
	}
	elseif (isset($_GET["error"]) && $_GET["error"] == 2)
	{
		$error = "<div class=\"error_head\">Fields should be numeric.</div>";
	}
	else
	{
		$error = "";
	}
	
	echo $error;
	echo $success;
?>
	<div id="content">
		<div class="title">
			<img src="../static/img/logo.png">
		</div>
		<div class="right_menu">

		<?php
		if (isset($_GET["sub"]) && $_GET["sub"] == "avatars")
		{
			if (isset($_GET["update"]) && $_GET["update"] == 1)
			{
				if (isset($_POST["token"]) && $_POST["token"] == md5($_SESSION["settings_token_1"]))
				{
					$idle = trim($db->real_escape_string($_POST["idle"]));
		
					if ($idle == null)
					{
						header('location: index.php?page=settings&sub=avatars&error=1');
					}
					else
					{
						if (is_numeric($idle))
						{
							// Update settings
							$db->query("UPDATE `site_settings` SET `avatar_timeout` = '{$idle}'");
							
							header('location: index.php?page=settings&sub=avatars&success=1');
						}
						else
						{
							header('location: index.php?page=settings&sub=avatars&error=2');
						}
					}
				}
				else
				{
					echo "
					<div class=\"box\">
						<div class=\"title\" style=\"margin-top:0px; margin-bottom:10px;\">Error</div>
						Invalid submission token receieved, please try again.
					</div>";								
				}
			}
			else
			{
				// update token
				if (!isset($_SESSION["settings_token_1"]))
				{
					$_SESSION["settings_token_1"] = sha1(rand(128, 5000));
				}
				
				echo "<div class=\"title2\">Avatar Settings</div>";
				echo "
				<div class=\"editor\">
					<form action=\"index.php?page=settings&sub=avatars&update=1\" method=\"post\">
						<strong>Idle Kicker</strong><br />
						<span style=\"font-size:12px;\">How long (in minutes) before an avatar is disconnected due to be becoming idle.</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<input type=\"text\" maxlength=\"6\" name=\"idle\" value=\"{$settings["avatar_timeout"]}\">
						<div class=\"clear\"></div>
						
						<input type=\"hidden\" name=\"token\" value=\"" . md5($_SESSION["settings_token_1"]) . "\">
						<input type=\"submit\" style=\"min-width:100px; border-radius:5px;\" value=\"Save Settings\">
					</form>
				</div>";
			}
		}
		elseif (isset($_GET["sub"]) && $_GET["sub"] == "password")
		{
			if (isset($_GET["update"]) && $_GET["update"] == 1)
			{
				if (isset($_POST["token"]) && $_POST["token"] == md5($_SESSION["settings_token_2"]))
				{
					if (isset($_POST["current"]) && $_POST["current"] != null && isset($_POST["new"]) && $_POST["new"] != null)
					{
						if (sha1(str_rot13($_POST["current"] . $keys["enc_1"])) == $GLOBALS["settings"]["admin_password"])
						{
							$new = trim($db->real_escape_string(sha1(str_rot13($_POST["new"] . $keys["enc_1"]))));
							$db->query("UPDATE `site_settings` SET `admin_password` = '{$new}'");
							
							header('location: index.php?page=settings&sub=password&success=1');
						}
						else
						{
							echo "
							<div class=\"box\">
								<div class=\"title\" style=\"margin-top:0px; margin-bottom:10px;\">Error</div>
								The current admin password you entered is incorrect.
							</div>";							
						}
					}
					else
					{
						echo "
						<div class=\"box\">
							<div class=\"title\" style=\"margin-top:0px; margin-bottom:10px;\">Error</div>
							Both fields are required. Please go back and try again.
						</div>";						
					}
				}
				else
				{
					echo "
					<div class=\"box\">
						<div class=\"title\" style=\"margin-top:0px; margin-bottom:10px;\">Error</div>
						Invalid submission token receieved, please try again.
					</div>";								
				}
			}
			else
			{
				// update token
				if (!isset($_SESSION["settings_token_2"]))
				{
					$_SESSION["settings_token_2"] = sha1(rand(128, 5000));
				}
				
				echo "<div class=\"title2\">Admin Password</div>";
				echo "
				<div class=\"editor\">
					<form action=\"index.php?page=settings&sub=password&update=1\" method=\"post\">
						<strong>Current Password</strong><br />
						<span style=\"font-size:12px;\">Enter the current admin password.</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<input type=\"text\" maxlength=\"50\" name=\"current\">
						<div class=\"clear\"></div>
						
						<strong>New Password</strong><br />
						<span style=\"font-size:12px;\">Enter the new password you wish to use.</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<input type=\"text\" maxlength=\"50\" name=\"new\">
						<div class=\"clear\"></div>
						
						<input type=\"hidden\" name=\"token\" value=\"" . md5($_SESSION["settings_token_2"]) . "\">
						<input type=\"submit\" style=\"min-width:100px; border-radius:5px;\" value=\"Save Settings\">
					</form>
				</div>";
			}
		}
		else
		{
			if (isset($_GET["update"]) && $_GET["update"] == 1)
			{
				if (isset($_POST["token"]) && $_POST["token"] == md5($_SESSION["settings_token_4"]))
				{
					$url = trim($db->real_escape_string($_POST["url"]));
					$welcome = trim($db->real_escape_string($_POST["welcome"]));
					$auto_log = trim($db->real_escape_string($_POST["auto_log"]));
					
					if ($url == null)
					{
						header('location: index.php?page=settings&error=1');
					}
					else
					{
						if ($welcome == null)
						{
							$welcome = "";
						}
						
						// Update settings
						$db->query("UPDATE `site_settings` SET `site_url` = '{$url}', `welcome_msg` = '{$welcome}', `auto_log` = '{$auto_log}'");
						
						header('location: index.php?page=settings&success=1');
					}
				}
				else
				{
					echo "
					<div class=\"box\">
						<div class=\"title\" style=\"margin-top:0px; margin-bottom:10px;\">Error</div>
						Invalid submission token receieved, please try again.
					</div>";								
				}
			}
			else
			{
				// update token
				if (!isset($_SESSION["settings_token_4"]))
				{
					$_SESSION["settings_token_4"] = sha1(rand(128, 5000));
				}
				
				echo "<div class=\"title2\">General Settings</div>";
				echo "
				<div class=\"editor\">
					<form action=\"index.php?page=settings&update=1\" method=\"post\">
						<strong>Site URL (no trailing slash)</strong><br />
						<span style=\"font-size:12px;\">The url of your chat website.</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<input type=\"text\" maxlength=\"40\" name=\"url\" value=\"{$settings["site_url"]}\">
						<div class=\"clear\"></div>
						
						<strong>Welcome Message</strong><br />
						<span style=\"font-size:12px;\">This message is placed into the chat log by default. (NO HTML)</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<input type=\"text\" maxlength=\"60\" name=\"welcome\" value=\"{$settings["welcome_msg"]}\">
						<div class=\"clear\"></div>
						
						<strong>Open Chat Log After Login?</strong><br />
						<span style=\"font-size:12px;\">Should the chat log automatically open after the user logs in?</span>
						<div class=\"clear\" style=\"margin-top:5px;\"></div>
						<select name=\"auto_log\">
						";
						
						if ($GLOBALS["settings"]["auto_log"])
						{
							echo "
								<option value=\"1\">Opened By Default</option>
								<option value=\"0\">Closed By Default</option>
							";
						}
						else
						{
							echo "
								<option value=\"0\">Closed By Default</option>
								<option value=\"1\">Opened By Default</option>
							";						
						}
						
						echo "
						</select>
						<div class=\"clear\"></div>
						
						<input type=\"hidden\" name=\"token\" value=\"" . md5($_SESSION["settings_token_4"]) . "\">
						<input type=\"submit\" style=\"min-width:100px; border-radius:5px;\" value=\"Save Settings\">
					</form>
				</div>";
			}
		}
		?>
	
		</div>
		
		<div class="left_menu">
			<a href="index.php?page=settings"><img src="template/icons/settings_icon.png"> General Settings</a>
			<a href="index.php?page=settings&sub=avatars"><img src="template/icons/user_icon.png"> Avatar Settings</a>
			<a href="index.php?page=settings&sub=password"><img src="template/icons/manage_icon.png"> Admin Password</a>
		</div>
	</div>