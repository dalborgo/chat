<?php
	include("../core/rc/config.inc.php");
	
	if (isset($_GET["save"]))
	{
		if (isset($_POST["url"]) && $_POST["url"] != null && isset($_POST["password"]) && $_POST["password"] != null)
		{
			$password = trim($db->real_escape_string(sha1(str_rot13($_POST["password"] . $keys["enc_1"]))));
			$url = trim($db->real_escape_string($_POST["url"]));
			
			$db->query("INSERT INTO `site_settings` (site_url, avatar_timeout, welcome_msg, auto_log, admin_password) VALUES ('{$url}', '5', 'Virtual Chat Installed!', 1, '{$password}')");
			
			header('location: ?step=5');
		}
		else
		{
			echo "
				<div class=\"section\">
					<span style=\"float:left; margin-right:20px;\"><img src=\"images/error.png\"></span>
					There was an error configuring your website. Both fields are required to complete the installation process.
					<br /><br />
					[ <a href=\"javascript:history.back()\">Go back</a> ]
				</div>
			";		
		}
	}
	else
	{
?>
<div class="title" id="info" style="padding-bottom:10px; border-bottom:1px solid #eaeaea;">Website Settings <span style="float:right;">Step 4 of 4</span></div>
<p>
	Great! Your database is now configured and we can now create the settings for your Virtual Chat room.
	<br />
	<form action="?step=4&save=true" method="post">
		<div class="ftitle">
			Website URL<br />
			<span style="font-size:12px;">The URL to your website, do NOT include a trailing slash.</span>
		</div>
		<input type="text" name="url" placeholder="http://example.com | http://example.com/chat_folder">
		<br /><br />
		
		<div class="ftitle">
			Admin Password<br />
			<span style="font-size:12px;">The password required to access the admin panel.</span>
		</div>
		<input type="text" name="password" placeholder="Admin Password">	
		<br /><br />
		<input type="submit" style="padding:10px; background:#eaeaea; border-radius:4px; border:0px; color:#808080; width:740px;" value="Save Settings">
	</form>
</p>
<?php } ?>