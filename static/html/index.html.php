<!DOCTYPE HTML>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="static/css/static.css" />
	<link rel="stylesheet" type="text/css" href="static/css/sprites.css" />
</head>
<body>
	<div id="dimmer"></div>
	<div id="modalWorld">
		<div id="disconnect">
			<div id="disconnect_header">Lost Connection</div>
			<div id="disconnect_content">
				You have been disconnected from the chat room.<br />
				Please <a href="index.php">click here</a> to return to the login screen.
			</div>
		</div>
		<div id="help">
			<div id="help_header">Virtual Chat Software</div>
			<div id="help_content" style="text-align:left;">
				Developer: <a href="http://designskate.com" target="_blank">DesignSkate D'Trent</a><br />
				Software: Virtual Chat "Share Web"<br />
				Release Version: 1.0.0
			</div>
		</div>
		<div id="popdown">
			<!-- Chat Log -->
		</div>
	</div>
	<div id="loginWorld">
		<div id="avatar_chooser">
			<div id="male.png" class="sel_avatar" style="background:url('static/sprites/ss1/male.png') no-repeat;"></div>
			<div id="male_2.png" class="sel_avatar gray" style="background:url('static/sprites/ss1/male_2.png') no-repeat;"></div>
			<div id="female.png" class="sel_avatar gray" style="background:url('static/sprites/ss1/female.png') no-repeat;"></div>
			<div id="female_2.png" class="sel_avatar gray" style="background:url('static/sprites/ss1/female_2.png') no-repeat;"></div>
		</div>
		<div id="loginInfo">
			<input type="text" id="loginInput" placeholder="Choose a username" maxlength="15">
			<div id="loginButton">Login</div>
		</div>
	</div>
	<div id="containerWorld"></div>
	<div id="hud">
		<input type="text" id="chatbar" maxlength="50">
		<div id="sendchat">Send Chat</div>
		
		<div id="uibar">
			<img src="static/img/log.png" id="log" title="Chat Log">
			<img src="static/img/help.png" id="hd" title="Help">
		</div>
	</div>
</body>
<!-- Required Javascript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script><?php jsConfig(); ?></script>
<script src="client/doTimeout.js"></script>
<script src="client/hangout.js"></script>
</html>