<div class="title" id="info" style="padding-bottom:10px; border-bottom:1px solid #eaeaea;">File Check <span style="float:right;">Step 1 of 4</span></div>
<p>
	We're now checking the script's files to ensure they meet the requirements of this installer. You will be notified if they require modification.
	<br />
	<div id="filecheck"><img src="images/loader.gif"></div>
</p>
<script type="text/javascript">
$( document ).ready(function() {
	$.get( "installer/setup_tools/0_filecheck.php", function( data ) {
		$("#filecheck").html(data);
	});	
});
</script>