<?php
	/*
		Avatar Chat 1.0.0
		Login
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_POST["uname"]) && $_POST["uname"] != null)
	{
		$uname = $db->real_escape_string($_POST["uname"]);
		$query_users = $db->query("SELECT avatar_name, avatar_customID FROM `online_avatars` WHERE `avatar_name` = '{$uname}' OR `avatar_customID` = '{$_SESSION["myID"]}'");
		if ($query_users->num_rows > 0)
		{
			if (!isset($_POST["sprite"]) || isset($_POST["sprite"]) && !file_exists("../static/sprites/ss1/" . $db->real_escape_string($_POST["sprite"]) . ""))
			{
				$sAvatar = "male.png";
			}
			else
			{
				$sAvatar = $db->real_escape_string($_POST["sprite"]);
			}
			
			$this_user = $query_users->fetch_assoc();
			if ($this_user["avatar_customID"] == $_SESSION["myID"])
			{
				$db->query("DELETE FROM `online_avatars` WHERE `avatar_customID` = '{$_SESSION["myID"]}'");
				$db->query("INSERT INTO `online_avatars` (`avatar_customID`, `avatar_name`, `avatar_time`, `avatar_key`, `avatar_x`, `avatar_y`, `avatar_sprite`) 
												  VALUES ('{$_SESSION["myID"]}', '{$uname}', '{$config["time"]}', '{$_SESSION["token"]}', '150', '190', '{$sAvatar}')") or die($db->error);		
													
				echo 1;
			}
			else
			{
				echo 3;
			}
		}
		else
		{
			if (!isset($_POST["sprite"]) || isset($_POST["sprite"]) && !file_exists("../static/sprites/ss1/" . $db->real_escape_string($_POST["sprite"]) . ""))
			{
				$sAvatar = "male.png";
			}
			else
			{
				$sAvatar = $db->real_escape_string($_POST["sprite"]);
			}
			
			$db->query("INSERT INTO `online_avatars` (`avatar_customID`, `avatar_name`, `avatar_time`, `avatar_key`, `avatar_x`, `avatar_y`, `avatar_sprite`) 
											  VALUES ('{$_SESSION["myID"]}', '{$uname}', '{$config["time"]}', '{$_SESSION["token"]}', '150', '190', '{$sAvatar}')") or die($db->error);
			echo 1;
		}
	}
?>