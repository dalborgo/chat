<?php
	sleep(1);

	$aj_testFile0 = '../../../core/rc/textFile.txt';

	if ( !is_writable(dirname($aj_testFile0)) ) 
	{
		echo "<img src=\"images/cross_icon.png\">" . dirname($aj_testFile0) . " must be writable! (<a href=\"?step=1\">Retry</a>)";
	} 
	else 
	{
		echo "
			<img src=\"images/tick_icon.png\"> " . dirname($aj_testFile0) . " is writable.
			<br /><br />
			<a href=\"?step=2\" style=\"color:#4B892E;\">
				<div style=\"padding:10px; background:#E6F4DE; font-size:14px; border-radius:4px; cursor:pointer;\">
					Configure Database
				</div>
			</a>
		";
	}
?>