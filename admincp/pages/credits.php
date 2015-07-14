<?php
	/**
	 * Virtual Chat 1.0.0 release
	 * Software by DesignSkate
	 */
	 
	if (!isset($_SESSION["admin_session"]))
	{
		header('location: login.php');
		exit();
	}

?>
	<div id="content">
		<div class="title">
			<img src="../static/img/logo.png">
		</div>
		<div class="right_menu">
			<div class="title2">Virtual Chat Credits</div>
			Virtual Chat is developed by DesignSkate (<a href="http://designskate.com" target="_blank">DesignSkate.com</a>). Appropriate credit for icons used throughout the product
			can be found to the left hand side of this page.
	
			<div class="clear"></div>
			
			<div class="title2">Additional Terms</div>
			Virtual Chat is property of DesignSkate. The front-end copyright notice (Chat Software by DesignSkate) may be removed or altered providing you do not claim the software was created by you.
			Copyright notices on the back-end of the system (administration panel) and in Virtual Chat's source code may not be altered or removed for any reason.
			<br /><br />
			DesignSkate reserves the right to limit or terminate your client account (if activated on <a href="http://clients.designskate.com" target="_blank">clients.designskate.com</a>) if you do
			not follow the Additional Terms outlined above.
			
			<div class="clear"></div>
			
			<div class="title2">Artwork / Room Design</div>
			Virtual Chat is released with a room illustration created for the Virtual Chat software. It may not be resold, re-released or claimed as your own under any circumstances. DesignSkate permits 
			Virtual Chat's customers to use this artwork with the Virtual Chat software. To view the portfolio of the artist, please <a href="http://fitzberg.daportfolio.com/" target="_blank">click here</a>.
			<br /><br />
			Default sprites included with this product are property of Mizuko. DesignSkate does not permit the re-release of these sprites and they may only be used with the Virtual Chat software.
			<br /><br />
			Looking for no hassle room design? Please contact us for a quote. We handle everything from payments to dealing with illustrators. The process takes no longer than 2 weeks.
		</div>
		
		<div class="left_menu">
			<a href="http://designskate.com?ref=credits" target="_blank"><img src="template/icons/link_icon.png"> DesignSkate</a>
			<a href="https://www.iconfinder.com/iconsets/fatcow" target="_blank"><img src="template/icons/link_icon.png"> Farm-fresh icons</a>
			<a href="https://www.iconfinder.com/iconsets/silk2#readme" target="_blank"><img src="template/icons/link_icon.png"> Silk icons</a>
			<a href="https://www.iconfinder.com/iconsets/splashyIcons" target="_blank"><img src="template/icons/link_icon.png"> Splashyfish icons</a>
			<a href="http://fitzberg.daportfolio.com/" target="_blank"><img src="template/icons/illustration_icon.png"> Fitzberg</a>
			<a href="http://www.midaem.com/" target="_blank"><img src="template/icons/illustration_icon.png"> Mizuko</a>
		</div>
	</div>