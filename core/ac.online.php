<?php
	/*
		Avatar Chat 1.0.0
		Online Users
	*/
	
	include("rc/config.inc.php");
	
	$avatars = null;
	 
	$query_online = $db->query("SELECT * FROM `online_avatars`");
	if ($query_online->num_rows > 0)
	{
		$als_counter = 1;
		$online_count = 0;
		
		while($avatar = $query_online->fetch_assoc())
		{
			if ($avatar["avatar_customID"] != $_SESSION["myID"])
			{	
				$max_time = $avatar["avatar_time"] + $GLOBALS["settings"]["avatar_timeout"] * 60;
				if ($config["time"] > $max_time)
				{
					$db->query("DELETE FROM `online_avatars` WHERE `avatar_id` = '{$avatar["avatar_id"]}'");
					$db->query("INSERT INTO `events_queue` (`event_uid`, `event_type`, `event_data`, `event_time`) VALUES ('{$avatar["avatar_customID"]}', '2', '0', '{$config["micro"]}')");					
				}
				else
				{
					if ($als_counter != $query_online->num_rows)
					{
						$user_seperate = ",";
					}
					else
					{
						$user_seperate = null;
					}
					
					$avx = $avatar["avatar_X"];
					$avy = $avatar["avatar_Y"];
					
					echo "{$avatar["avatar_name"]}|{$avatar["avatar_customID"]}|{$avx}|{$avy}|{$avatar["avatar_sprite"]}", $user_seperate;	
					
					$online_count++;
					$als_counter++;
					unset($user_seperate);
				}
			}
		}
		
		if ($online_count == 0)
		{
			echo 0;
		}
	}
?>