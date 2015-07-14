<?php
	/*
		Avatar Chat 1.0.0
		Sessions
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_SESSION["myID"]))
	{
		$query_myid = $db->query("SELECT avatar_customID FROM `online_avatars` WHERE `avatar_customID` = '{$_SESSION["myID"]}'");
		if ($query_myid->num_rows > 0)
		{
			$query_messages = $db->query("SELECT * FROM `chat_messages` WHERE `chat_time` > '{$_SESSION["chatPoll"]}' AND `user_id` != '{$_SESSION["myID"]}'");
			if ($query_messages->num_rows > 0)
			{	
				$als_counter = 1;
				while($message = $query_messages->fetch_assoc())
				{
					if ($als_counter != $query_messages->num_rows)
					{
						$event_seperate = "/";
					}
					else
					{
						$event_seperate = null;
					}
					
					echo "{$message["user_id"]}|{$message["chat_msg"]}", $event_seperate;
					
					$als_counter++;
					unset($event_seperate);
				}
			}
			else
			{
				echo 0;
			}
			
			$_SESSION["chatPoll"] = $config["micro"];
		}
	}
?>