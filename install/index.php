<!doctype html>
<html>
<head>
<title>Virtual Chat Installer</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>
	html {
		padding-bottom:40px;
	}
	
	body {
		font-family: 'Open Sans', sans-serif;
		font-size:13px;
		color:#808080;
		background:#eaeaea;
		margin:0;
	}
	
	img {
		border:0px;
	}
	
	a {
		color:#4C77A5;
		text-decoration:none;
	}
	
	#docwrapper {	
		width:800px;
		margin:auto;
		background:#ffffff;
		overflow:auto;
		border-radius:0px 0px 4px 4px;
		-webkit-border-radius:0px 0px 4px 4px;
		-moz-border-radius:0px 0px 4px 4px;
		box-shadow: 5px 5px 5px #DDDDDD;
	}
	
	#docsidebar {
		width:120px;
		float:left;
		padding:20px;
		border-radius:4px;
		-webkit-border-radius:4px;
	}
	
	#docsidebar li { list-style:none; padding:0; margin-bottom:5px; padding-bottom:5px; border-bottom:1px solid #f8f8f8; }
	
	#docmain {
		float:right;
		width:740px;
		padding:20px;
		overflow:auto;
	}
	
	.title {
		font-size:16px;
	}
	
	.sub_title {
		font-size:14px;
		margin-bottom:5px;
		color:#000000;
	}
	
	.notes {
		padding:5px;
		margin-top:10px;
		margin-bottom:10px;
		color:#ffffff;
		border-radius:3px;
		background:#FF945D;
	}
	
	p {
		margin-top:10px;
		margin-bottom:20px;
	}
	
	#header {
		font-size:16px;
		border-bottom:1px solid #eaeaea;
	}
	
	#footer {
		margin-top:40px;
		font-size:11px;
		color:#c0c0c0;
	}
	
	.info {
		font-size:10px;
		margin-bottom:10px;
	}
	
	.section {
		padding:10px;
		margin-bottom:20px;
		border:1px solid #eaeaea;
		font-size:13px;
		background:#ffffff;
		margin-top:10px;
	}
	
	.ftitle {
		font-size:14px;
		border-bottom:1px solid #eaeaea;
		padding-bottom:10px;
		margin-bottom:10px;
	}
	
	input[type="text"] {
	  padding: 10px;
	  border: 1px solid #eaeaea;
	  border-bottom: solid 2px #c9c9c9;
	  transition: border 0.3s;
	  width:718px;
	  color:#808080;
	  font-family: 'Open Sans', sans-serif;
	}
	
	input[type="text"]:focus,
	input[type="text"].focus {
	  border-bottom: solid 2px #969696;
	}
</style>
</head>
<body>
	<div id="docwrapper">
		<div id="header">
			<img src="images/logo.png" style="margin-bottom:-5px;">
		</div>
		<div id="docmain">
			<?php
				if (!isset($_GET["step"]) || isset($_GET["step"]) && $_GET["step"] == "0")
				{
					include("installer/step_0.php");
				}
				
				if (isset($_GET["step"]) && $_GET["step"] == 1)
				{
					include("installer/step_1.php");
				}
				
				if (isset($_GET["step"]) && $_GET["step"] == 2)
				{
					include("installer/step_2.php");
				}
				
				if (isset($_GET["step"]) && $_GET["step"] == 3)
				{
					include("installer/step_3.php");
				}
				
				if (isset($_GET["step"]) && $_GET["step"] == 4)
				{
					include("installer/step_4.php");
				}
				
				if (isset($_GET["step"]) && $_GET["step"] == 5)
				{
					include("installer/step_5.php");
				}
			?>	
			<div id="footer">
				Virtual Chat Installer<br />
				<a href="http://designskate.com/virtualchat">Chat Software</a> by DesignSkate
			</div>
		</div>
	</div>
</body>
</html>