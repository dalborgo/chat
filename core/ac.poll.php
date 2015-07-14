<?php
	/*
		Avatar Chat 1.0.0
		Poll for events
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_SESSION["myID"]))
	{
		$query_myid = $db->query("SELECT avatar_customID FROM `online_avatars` WHERE `avatar_customID` = '{$_SESSION["myID"]}'");
		if ($query_myid->num_rows > 0)
		{
			$query_events = $db->query("SELECT * FROM `events_queue`");
			if ($query_events->num_rows > 0)
			{
				if ($query_events->num_rows > 50)
				{
					$db->query("DELETE FROM events_queue ORDER BY event_id ASC LIMIT 10");
				}
				
				$als_counter = 1;
				while($event = $query_events->fetch_assoc())
				{
					if ($event["event_uid"] != $_SESSION["myID"])
					{
						if ($event["event_time"] > $_SESSION["lastPoll"])
						{
							if ($als_counter != $query_events->num_rows)
							{
								$event_seperate = "/";
							}
							else
							{
								$event_seperate = null;
							}
							
							$query_avatars = $db->query("SELECT avatar_customID, avatar_name, avatar_sprite FROM `online_avatars` WHERE `avatar_customID` = '{$event["event_uid"]}'");
							$avatar = $query_avatars->fetch_assoc();
							
							if ($event["event_uid"] != 0)
							{
								echo "{$event["event_uid"]}|{$event["event_type"]}|{$event["event_data"]}|{$avatar["avatar_name"]}|{$avatar["avatar_sprite"]}", $event_seperate;	
							}
							
							$als_counter++;
							unset($event_seperate);
						}
					}
				}
				
				$_SESSION["lastPoll"] = $config["micro"];
			}
		}
		else
		{
			echo "3";
		}
	}
?>