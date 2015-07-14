<?php
	if (!isset($_SESSION["admin_session"]))
	{
		header('location: login.php');
		exit();
	}
	
	$admin = mysqli_fetch_array($db->query("SELECT * FROM `admin`"));
	$online_users = $db->query("SELECT * FROM `online_avatars`");
	
	if (isset($_GET["refresh"]) && $_GET["refresh"] == 1)
	{
		$db->query("UPDATE `admin` SET `last_pull` = '0'");
		header('location: index.php?page=home');
	}
?>
	<div id="content">
		<div class="title">
			<img src="../static/img/logo.png">
		</div>
		<div class="right_menu">
			<div class="title2">
				Virtual Chat News 
				<span style="float:right; font-size:11px; margin-top:5px;"><a href="?page=home&refresh=1">Refresh Now</a></span>
			</div>
			<div id="news">
			
			<?php
				/****
				* To prevent the constant loading of news from DesignSkate's server
				* which might slow down your site, this cache like system will check for
				* updated news every 2 days.
				****/
				
				if ($admin["last_pull"] > strtotime("-2 days") && $admin["last_pull"] != 0)
				{
					// load cached news
					include("news/news.html");
				}
				else
				{
					// 2 days past pull latest news
					$timeouts = stream_context_create(array(
						'http' => array(
							'timeout' => 2
						)
					));
					
					$news = @file_get_contents('http://designskate.com/news/virtualchat.html', 0, $timeouts);
					
					// update news
					if (!empty($news))
					{
						$file = fopen("news/news.html", 'w+');
						fwrite($file, $news);
						fclose($file);
						
						$db->query("UPDATE `admin` SET `last_pull` = '{$time}'");
						echo $news;
					}
					else
					{
						// failed to retrieve latest news document
						include("news/news.html");
					}
				}
				
				// Display last update
				if ($admin["last_pull"] == 0)
				{
					$last_pull = date("jS \of F Y h:i", $time);
				}
				else
				{
					$last_pull = date("jS \of F Y h:i", $admin["last_pull"]);
				}
				
				echo "<br /><br /><em><small>Last checked " . $last_pull . "</small></em>";
			?>		
			
			</div>		
			
		</div>
		
		<div class="left_menu">
			<a href="index.php"><img src="template/icons/home_icon.png"> Admin Home</a>
			<a href="index.php?page=users"><img src="template/icons/manage_icon.png"> Online Avatars</a>
		</div>
		
		<div class="left_menu">
			<a href="?page=users"><img src="template/icons/online_icon.png"> <strong><?php echo $online_users->num_rows; ?></strong> Avatars Online</a>
		</div>
	</div>
</body>
</html>