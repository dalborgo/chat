<div class="title" id="info" style="padding-bottom:10px; border-bottom:1px solid #eaeaea;">Database Configuration <span style="float:right;">Step 3 of 4</span></div>
<p>
	Please do not close this page while your database is being configured.
	<br /><br />
	<img src="images/loader.gif" style="float:left; margin-right:10px;"> <span id="pcnt" style="float:left; margin-top:-1px;">0% Installed</span>
</p>
<script type="text/javascript">
$( document ).ready(function() {
	$.ajax({
		type: 'POST',
		url: 'installer/setup_tools/2_tableTool.php',
		data: {step: 1},
		success:function(response)
		{	
			// 1 step
			if (response == 1)
			{
				$("#pcnt").html("25% Installed");
				
				$.ajax({
					type: 'POST',
					url: 'installer/setup_tools/2_tableTool.php',
					data: {step: 2},
					success:function(response)
					{	
						// 2 step
						if (response == 1)
						{
							$("#pcnt").html("50% Installed");
						}

						$.ajax({
							type: 'POST',
							url: 'installer/setup_tools/2_tableTool.php',
							data: {step: 3},
							success:function(response)
							{	
								// 3 step
								if (response == 1)
								{
									$("#pcnt").html("75% Installed");
								}
								
								$.ajax({
									type: 'POST',
									url: 'installer/setup_tools/2_tableTool.php',
									data: {step: 4},
									success:function(response)
									{	
										// 4 step
										if (response == 1)
										{
											$("#pcnt").html("99% Installed");
										}
										
										$.ajax({
											type: 'POST',
											url: 'installer/setup_tools/2_tableTool.php',
											data: {step: 5},
											success:function(response)
											{	
												// 5 step
												if (response == 1)
												{
													$("#pcnt").html("100% Installed");
													
													setTimeout(function() {
														  window.location.href = '?step=4';
													}, 3000);
												}
											}
										});	
									}
								});	
							}
						});	
					}
				});	
			}
		}
	});	
});
</script>