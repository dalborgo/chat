<?php
	/*
		Avatar Chat 1.0.0
		Functions
	*/
	
	function jsConfig()
	{
		echo "
			var sessionID = \"{$_SESSION["myID"]}\";
			var myToken = \"{$_SESSION["token"]}\";
			var siteURL = \"{$GLOBALS["settings"]["site_url"]}\";
			var welcomeMSG = \"{$GLOBALS["settings"]["welcome_msg"]}\";
			var autolog = \"{$GLOBALS["settings"]["auto_log"]}\";
		";
	}
?>