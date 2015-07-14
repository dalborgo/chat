<?php
	sleep(1);
	
	include("../../../core/rc/database.inc.php");
	
	$db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	
	if (isset($_POST["step"]))
	{
		if ($_POST["step"] == 1)
		{
			// Install Admin Table
			$db->query("
						CREATE TABLE IF NOT EXISTS `admin` (
						  `last_ull` int(20) NOT NULL,
						  UNIQUE KEY `last_ull` (`last_ull`)
						) ENGINE=InnoDB DEFAULT CHARSET=latin1
			");

			echo 1;
		}
		
		if ($_POST["step"] == 2)
		{
			// Install Chat Messages
			$db->query("
						CREATE TABLE IF NOT EXISTS `chat_messages` (
						  `chat_id` int(4) NOT NULL AUTO_INCREMENT,
						  `user_id` int(4) NOT NULL,
						  `chat_msg` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  `chat_time` varchar(16) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  PRIMARY KEY (`chat_id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1
			");

			echo 1;
		}
		
		if ($_POST["step"] == 3)
		{
			// Install Event Queue
			$db->query("
						CREATE TABLE IF NOT EXISTS `events_queue` (
						  `event_id` int(6) NOT NULL AUTO_INCREMENT,
						  `event_uid` int(4) NOT NULL,
						  `event_type` int(3) NOT NULL,
						  `event_data` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  `event_time` varchar(16) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  PRIMARY KEY (`event_id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1
			");

			echo 1;
		}
		
		if ($_POST["step"] == 4)
		{
			// Install Online Avatars
			$db->query("
						CREATE TABLE IF NOT EXISTS `online_avatars` (
						  `avatar_id` int(4) NOT NULL AUTO_INCREMENT,
						  `avatar_customID` int(6) NOT NULL,
						  `avatar_name` varchar(15) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  `avatar_time` int(20) NOT NULL,
						  `avatar_X` int(4) NOT NULL,
						  `avatar_Y` int(4) NOT NULL,
						  `avatar_key` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  `avatar_sprite` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  PRIMARY KEY (`avatar_id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1
			");

			echo 1;
		}
		
		if ($_POST["step"] == 5)
		{
			// Install Settings
			$db->query("
						CREATE TABLE IF NOT EXISTS `site_settings` (
						  `site_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  `avatar_timeout` int(4) NOT NULL DEFAULT '5',
						  `welcome_msg` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL DEFAULT 'Welcome to Virtual Chat.',
						  `auto_log` int(1) NOT NULL DEFAULT '0',
						  `admin_password` varchar(150) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
						  UNIQUE KEY `site_url` (`site_url`)
						) ENGINE=InnoDB DEFAULT CHARSET=latin1
			");

			echo 1;
		}
	}
?>