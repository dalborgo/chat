<?php
	/*
		Avatar Chat 1.0.0
		Sessions
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_POST["token"]) && $_POST["token"] != null);
	{
		$token = $db->real_escape_string($_POST["token"]);
		
		$query_db = $db->query("SELECT * FROM `online_avatars` WHERE `avatar_key` = '{$token}'");
		if ($query_db->num_rows > 0)
		{
			$this_avatar = $query_db->fetch_assoc();
			
			$db->query("DELETE FROM `online_avatars` WHERE `avatar_key` = '{$token}'");
			$db->query("INSERT INTO `events_queue` (`event_uid`, `event_type`, `event_data`, `event_time`) VALUES ('{$this_avatar["avatar_customID"]}', '2', '0', '{$config["micro"]}')");
		}
		else
		{
			echo 1;
		}
	}
?>