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
	 
	if (isset($_GET["success"]))
	{
		if ($_GET["success"] == 1)
		{
			$success = "<div class=\"success_head\">The avatar has been kicked.</div>";
		}
	}
	else
	{
		$success = "";
	}
	
	if (isset($_GET["error"]))
	{
		if ($_GET["error"] == 1)
		{
			$error = "<div class=\"error_head\">Unable to find the requested avatar.</div>";
		}
	}
	else
	{
		$error = null;
	}
	
	echo $success, $error;
	
	if (isset($_GET["uid"]) && isset($_GET["action"]))
	{
		if ($_GET["action"] == "kick")
		{
			$uid = trim($db->real_escape_string($_GET["uid"]));
			$query_uid = $db->query("SELECT avatar_key, avatar_id, avatar_customID FROM `online_avatars` WHERE `avatar_key` = '{$uid}'");
			if ($query_uid->num_rows > 0)
			{
				$this_uid = $query_uid->fetch_array();
				
				// Kick the user and send event command
				$db->query("DELETE FROM `online_avatars` WHERE `avatar_id` = '{$this_uid["avatar_id"]}'");
				$db->query("INSERT INTO `events_queue` (`event_uid`, `event_type`, `event_data`, `event_time`) VALUES ('{$this_uid["avatar_customID"]}', '2', '0', '{$config["micro"]}')");	
				
				header('location: index.php?page=users&success=1');
			}
			else
			{
				header('location: index.php?page=users&error=1');
			}
		}
	}
?>
	<div id="content">
		<div class="title">
			<img src="../static/img/logo.png">
		</div>
		<div class="right_menu" style="float:left; width:920px;">
		
			<?php
				echo "
				<div class=\"title2\">
					Online Avatars
				</div>";
			
				// pagination
				$table = "online_avatars";
				$list = "?page=users";
				$limit = 10;

				include("../core/paginate.php");
				
				$query_avatars = $db->query("SELECT * FROM `$table` $extra ORDER BY abs(`avatar_id`) ASC LIMIT $start, $limit");
				if ($query_avatars->num_rows > 0)
				{
					echo "
					<table class=\"forum\"\">
						<tr>
							<th style=\"width:40px;\">Sprite</th>
							<th>Avatar Details</th>
						</tr>
					";
					
					while($avatar = $query_avatars->fetch_assoc())
					{
						echo "
						<tr>
							<td style=\"text-align:center;\">
								<div style=\"background:url('../static/sprites/ss1/{$avatar["avatar_sprite"]}') no-repeat;\" class=\"sprite\">
							</td>
							<td>
								<span style=\"float:left; margin-top:-20px;\">
									<strong>Username</strong>: {$avatar["avatar_name"]}<br />
									<strong>Custom ID</strong>: {$avatar["avatar_customID"]}<br />
									<strong>Last Update</strong>: " . date("jS \of F Y h:i", $avatar["avatar_time"]) . "<br />
									<strong>XY Coordinates</strong>: X: {$avatar["avatar_X"]} / Y: {$avatar["avatar_Y"]}
								</span>
								
								<span style=\"float:right; margin-top:-20px;\">
									<a href=\"index.php?page=users&uid={$avatar["avatar_key"]}&action=kick\"><img src=\"template/icons/kick_icon.png\" title=\"Kick Avatar\">
								</span>
							</td>
						</tr>";
					}
					
					echo "</table>";
					echo $paginate;
				}
				else
				{
					echo "No online avatars found.";
				}
			?>
		</div>
	</div>