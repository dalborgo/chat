<?php
	if (isset($_GET["connect"]) && $_GET["connect"])
	{
		function escape($value) 
		{
			$return = '';
			
			for($i = 0; $i < strlen($value); ++$i) 
			{
				$char = $value[$i];
				$ord = ord($char);
				if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
				{
					$return .= $char;
				}
				else
				{
					$return .= '\\x' . dechex($ord);
				}
			}
			return $return;
		}
		
		if (!isset($_POST["host"])): $host == null; endif;
		if (!isset($_POST["username"])): $user == null; endif;
		if (!isset($_POST["password"])): $pass == null; endif;
		if (!isset($_POST["name"])): $name == null; endif;
		if (!isset($_POST["enc"])): $enc == null; endif;
		
		$host = trim(escape($_POST["host"]));
		$user = trim(escape($_POST["username"]));
		$pass = trim(escape($_POST["password"]));
		$name = trim(escape($_POST["name"]));
		$enc = trim(escape($_POST["enc"]));
		
		$db = @mysqli_connect($host, $user, $pass, $name);
		
		# Connection Check / Installation Check
		if (!($db))
		{
			echo "
				<div class=\"section\">
					<span style=\"float:left; margin-right:20px;\"><img src=\"images/error.png\"></span>
					There was an error whilst connecting to the database. Ensure that the username and password are correct, have permission to access the database and that the database exists.
					<br /><br />
					[ <a href=\"javascript:history.back()\">Go back</a> ]
				</div>
			";
		}
		else
		{
			if (trim($host) == null || $host == ""){ $jsHost = "empty"; } else { $jsHost = $host; }
			if (trim($user) == null || $user == ""){ $jsUser = "empty"; } else { $jsUser = $user; }
			if (trim($pass) == null || $pass == ""){ $jsPass = "empty"; } else { $jsPass = $pass; }
			if (trim($name) == null || $name == ""){ $jsName = "empty"; } else { $jsName = $name; }
			if (trim($enc) == null || $enc == ""){ $jsEnc = "empty"; } else { $jsEnc = $enc; }
			
			echo "
				<script type=\"text/javascript\">
					var jshost = \"" . $jsHost . "\";
					var jsuser = \"" . $jsUser . "\";
					var jspass = \"" . $jsPass . "\";
					var jsname = \"" . $jsName . "\";
					var jsenc = \"" . $jsEnc . "\";
					
					$.ajax({
						type: 'POST',
						url: 'installer/setup_tools/1_createConfig.php',
						data: {host: jshost, user: jsuser, pass: jspass, name: jsname, enc: jsenc},
						success:function(response)
						{
							if (response == 1)
							{
								window.location.href = '?step=3';
							}
							else
							{
								$('#e_box').html('<div class=\"section\"><span style=\"float:left; margin-right:20px;\"><img src=\"images/error.png\"></span>There was an error configuring the database. Ensure `core/rc/` can be written to.</div>');
							}
						}
					});	
				</script>
				
			<div id=\"e_box\">
				<div class=\"title\" id=\"info\" style=\"padding-bottom:10px; border-bottom:1px solid #eaeaea;\">Database Configuration <span style=\"float:right;\">Step 2 of 4</span></div>
				<p>
					<br />
					<img src=\"images/loader.gif\" style=\"float:left; margin-right:10px;\"> <span id=\"pcnt\" style=\"float:left; margin-top:-1px;\">Connnecting...</span>
				</p>
			</div>
			";
		}
	}
	else
	{
?>
<div class="title" id="info" style="padding-bottom:10px; border-bottom:1px solid #eaeaea;">Database Configuration <span style="float:right;">Step 2 of 4</span></div>
<p>
	Your file permissions look good! Now let's configure the database details. You should have already created a new database, but if not, please do so now. When that's ready, enter the details below.
	<br />
	<form action="?step=2&connect=true" method="post">
		<div class="ftitle">Database Host</div>
		<input type="text" name="host" placeholder="localhost">
		<br /><br />
		<div class="ftitle">Database Username</div>
		<input type="text" name="username" placeholder="Database Username">	
		<br /><br />
		<div class="ftitle">Database Password</div>
		<input type="text" name="password" placeholder="Database Password">
		<br /><br />
		<div class="ftitle">Database Name</div>
		<input type="text" name="name" placeholder="Database Name">
		<br /><br />
		<div class="ftitle">Unique Encryption Key</div>
		<input type="text" name="enc" value="<?php echo md5(rand(1,4000)); ?>">
		<br /><br />
		<input type="submit" style="padding:10px; background:#eaeaea; border-radius:4px; border:0px; color:#808080; width:740px;" value="Test Database Connection">
	</form>
</p>
<?php } ?>