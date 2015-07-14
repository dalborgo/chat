<?php
	/*
		Avatar Chat 1.0.0
		Walk
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_SESSION["myID"]))
	{
		if (isset($_POST["token"]) && $_POST["token"] != null);
		{
			if ($_POST["token"] == $_SESSION["token"])
			{
				$query_db = $db->query("SELECT * FROM `online_avatars` WHERE `avatar_customID` = '{$_SESSION["myID"]}' AND `avatar_key` = '{$_SESSION["token"]}'");
				if ($query_db->num_rows > 0)
				{
					if (is_numeric($_POST["xpos"]) && is_numeric($_POST["ypos"]))
					{
						$x = $db->real_escape_string($_POST["xpos"]);
						$y = $db->real_escape_string($_POST["ypos"]);
						
						$db->query("UPDATE `online_avatars` SET `avatar_x` = '{$x}', `avatar_y` = '{$y}', `avatar_time` = '{$config["time"]}' WHERE `avatar_customID` = '{$_SESSION["myID"]}'");
						$db->query("INSERT INTO `events_queue` (`event_uid`, `event_type`, `event_data`, `event_time`) VALUES ('{$_SESSION["myID"]}', '1', '{$x},{$y}', '{$config["micro"]}')");
						
						echo 2;
					}
				}
				else
				{
					echo 1;
				}
			}
			else
			{
				echo 1;
			}
		}
	}
?>