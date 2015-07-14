<?php
	/*
		Avatar Chat 1.0.0
		Sessions
	*/
	
	include("rc/config.inc.php");
	
	if (isset($_SESSION["myID"]) && isset($_POST["chat"]))
	{
		if (isset($_POST["token"]) && $_POST["token"] != null)
		{
			if ($_POST["token"] == $_SESSION["token"])
			{
				$query_db = $db->query("SELECT * FROM `online_avatars` WHERE `avatar_customID` = '{$_SESSION["myID"]}' AND `avatar_key` = '{$_SESSION["token"]}'");
				if ($query_db->num_rows > 0)
				{
					$chat = trim($db->real_escape_string($_POST["chat"]));
					$db->query("INSERT INTO `chat_messages` (`user_id`, `chat_msg`, `chat_time`) VALUES ('{$_SESSION["myID"]}', '{$chat}', '{$config["micro"]}')");
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