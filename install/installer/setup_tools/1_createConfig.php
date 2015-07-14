<?php
	sleep(1);
	
	if (!isset($_POST["host"]))
	{
		die("403");
	}
	else
	{
		$host = trim($_POST["host"]);
		$user = trim($_POST["user"]);
		$pass = trim($_POST["pass"]);
		$name = trim($_POST["name"]);
		$enc = trim($_POST["enc"]);
		
		if ($host == "empty")
		{
			$host = "localhost";
		}
		
		if ($user == "empty")
		{
			$user = "";
		}
		
		if ($pass == "empty")
		{
			$pass = "";
		}
		
		if ($name == "empty")
		{
			$name == "";
		}
		
		if ($enc == "empty")
		{
			$enc = md5(rand(1,4000));
		}
		
		$config_file = '<?php
	/**
		Avatar Chat
		Software by DesignSkate
	*/
	 
	//
	// Please configure the following MySQL settings
	$DB_HOST = "' . $host . '";
	$DB_USER = "' . $user . '";
	$DB_PASS = "' . $pass . '";
	$DB_NAME = "' . $name . '";
	
	//
	// The following encryption keys should not be modified post installation
	$keys["enc_1"] = "' . $enc . '";
	$installed = true;
?>';	

		$write_config = fopen("../../../core/rc/database.inc.php", "w+");
		fwrite($write_config, $config_file);
		fclose($write_config);	

		echo 1;
	}
?>