/*
	Avatar Chat 1.0.0
*/

/*
	Configure Global Variables
*/

var globalRooms = ["lobby"];
var sessionData = [];
var c = 0;
var el = $("body");
var sprite = "ss1";
var selectedAvatar = "male.png";
var audio = null;
var allowInput = false;
var myName = null;
var allowMove = true;
var pd = false;
var hd = false;

var sfx_newMessage = document.createElement('audio');
var sfx_click = document.createElement('audio');

sfx_newMessage.setAttribute('src', 'static/audio/sfx_newMessage.mp3');
sfx_click.setAttribute('src', 'static/audio/sfx_click.mp3');

/*
	Sprite Variables
*/

var body = "ss1/male.png";

/*
	Additional Configs
*/

sessionData[c] = {};

/*
	Define Functions
*/

$( "#log" ).click(function() { 
	if (pd)
	{
		pd = false;
		$( "#popdown" ).slideUp( "fast", function() {});
	}
	else
	{
		pd = true;
		$( "#popdown" ).slideDown( "fast", function() {});
	}
});

$( "#hd" ).click(function() { 
	if (hd)
	{
		hd = false;
		$( "#help" ).fadeOut( "fast", function() {});
	}
	else
	{
		hd = true;
		$( "#help" ).fadeIn( "fast", function() {});
	}
});

$( "#sendchat" ).click(function() {
	submitChat($("#chatbar").val());
});

$(document).keypress(function(e) {
	if(e.which == 13) {
		submitChat($("#chatbar").val());
	}
});

function submitChat(chatMsg)
{
	if (allowInput)
	{
		var finalMsg = chatMsg.replace(/(<([^>]+)>)/ig, '');
		if ($.trim(finalMsg) != "" && $.trim(finalMsg) != null)
		{
			var limitLen = finalMsg.toLowerCase(finalMsg.substring(0, 40));
			
			$("#mybubble").css('z-index', 6000);
			$("#mybubble").html(limitLen).removeClass("red");
			$("#mybubble").show();
			
			$.doTimeout( 'closeBubble' );
			$.doTimeout( 'closeBubble', 5000, function(){
				$("#mybubble").fadeOut("slow");
			});
			
			$("#chatbar").val("");
			
			$.ajax({
				type: 'POST',
				url: siteURL + '/core/ac.chat.php',
				data: {token: myToken, chat: limitLen},
				success:function(response)
				{
					// done
				}
			});	
			
			$("#popdown").prepend("<div class=\"message\"><div class=\"submitter sme\">[YOU]</div><div class=\"msg\">" + limitLen + "</div>").removeClass("red");
		}
	}
}

chat_poll = function()
{
	if (allowInput)
	{
		$.ajax({
			url: siteURL + '/core/ac.retrieveChat.php',
			cache: false,
			success: function(html)
			{
				if (html != 0)
				{
					events = html.split ( "/" );
					$.each(events, function(k, v)
					{
						chat = v.split( "|" );
						
						if ($("#"+ $.trim($.trim(chat[0])) + "_chat").length) 
						{
							$("#"+ $.trim($.trim(chat[0])) + "_chat").css('z-index', 6000);
							$("#"+ $.trim(chat[0]) + "_chat").html($.trim(chat[1]).toLowerCase()).removeClass("red");
							$("#"+ $.trim(chat[0]) + "_chat").show();
							
							$.doTimeout( 'closeBubble_'+$.trim(chat[0])+'' );
							$.doTimeout( 'closeBubble_'+$.trim(chat[0])+'', 5000, function(){
								$("#"+ $.trim(chat[0]) + "_chat").fadeOut("slow");
							});
							
							$("#popdown").prepend("<div class=\"message\"><div class=\"submitter\">[" + $( "#" + $.trim(chat[0]) ).attr( "cname" ) + "]</div><div class=\"msg\">" + $.trim(chat[1]) + "</div>").removeClass("red");
							
							sfx_newMessage.play();
						}
					});
				}
			}
		});
	}
};

events_poll = function()
{
	if (allowInput)
	{
		$.ajax({
			url: siteURL + '/core/ac.poll.php',
			cache: false,
			success: function(html)
			{
				if (html == 3) // Remove Local Client
				{
					allowInput = false;
					
					$("#disconnect").fadeIn("fast");
					$("#dimmer").fadeIn("fast");
					$("#popdown").fadeOut("Slow");
					pd = false;
				}
				else
				{
					events = html.split ( "/" );
					$.each(events, function(k, v)
					{
						tv = v.split( "|" );
					
						switch(tv[1])
						{
							case "1": // Move avatars
							{
								gt = tv[2].split( "," );
								
								if ($('#'+ $.trim(tv[0]) +'').length)
								{
									var offset = $('#'+ $.trim(tv[0]) +'').offset();
									var parentOffset = $('#'+ $.trim(tv[0]) +'').parent().offset();
									
									if (gt[0] == offset.left && gt[1] == offset.top)
									{
										// don't move
									}
									else
									{
										if (gt[0] > offset.left - parentOffset.left)
										{
											$( "#"+ $.trim(tv[0]) +"" ).removeClass( "normal left" );
											$( "#"+ $.trim(tv[0]) +"" ).addClass( "right" );
											$( "#"+ $.trim(tv[0]) +"" ).css('background-image', 'url(static/sprites/' + sprite + '/'+ $.trim(tv[4]) +')');
										}
										else
										{
											$( "#"+ $.trim(tv[0]) +"" ).removeClass( "normal right" );
											$( "#"+ $.trim(tv[0]) +"" ).addClass( "left" );		
											$( "#"+ $.trim(tv[0]) +"" ).css('background-image', 'url(static/sprites/' + sprite + '/'+ $.trim(tv[4]) +')');
										}
										
										$("#"+$.trim(tv[0])+"").offset({ top: gt[1], left: gt[0]});
									}
									
									$("#username_"+$.trim(tv[0])+"").val($.trim(tv[3]));
								}
								
								break;
							}
							
							case "2": // Remove avatars
							{
								if ($('#'+ $.trim(tv[0]) +'').length)
								{
									$("#"+ $.trim(tv[0]) + "").remove();
								}
								
								break;
							}
						}
					});	
				}
			},
		});
	}
};

users_poll = function()
{
	if (allowInput)
	{
		$.ajax({
			url: siteURL + '/core/ac.online.php',
			cache: false,
			success: function(response)
			{
				if ($.trim(response) != "0")
				{
					avatars = response.split ( "," );
					$.each(avatars, function(k, v)
					{
						tv = v.split( "|" );
						
						if (!$('#'+ $.trim(tv[1]) +'').length)
						{
							if (typeof tv[2] !== 'undefined')
							{
								$('<div id="'+ $.trim(tv[1]) +'" cName="' + $.trim(tv[0]) + '" class="avatar normal" style="top:'+tv[3]+'px; left:'+tv[2]+'px;"></div>').appendTo('#gameRoom');
								$( "#"+ $.trim(tv[1]) +"" ).css('background-image', 'url(static/sprites/' + sprite + '/'+ $.trim(tv[4]) +')');
								$('<div id="username_' + $.trim(tv[0]) + '" class="username">' + $.trim(tv[0]) + '</div>').appendTo('#'+ $.trim(tv[1]) +'');
								$('<div id="' + $.trim(tv[1]) + '_chat" class="bubble"></div>').appendTo('#'+ $.trim(tv[1]) +'');
								
								$("body").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", "#" + tv[1] + "", function(e)
								{ 
									$(this).removeClass( "right left" );
									$(this).addClass( "normal" );
								});
							}
						}
					});
				}
			}
		});
	}
};

function loadRoom(roomID)
{
	if (globalRooms.indexOf(roomID) != -1)
	{
		$.ajax({
			url: 'static/rooms/' + roomID + '/config.xml',
			type: "GET",
			dataType: "xml",
			success: function (config) 
			{
				/*
					Main Room Data
				*/
				$(config).find('mainroom').each(function () 
				{
					var roomData = $(this).text().split ( "|" );
					$('<map class="map" name="map" style="cursor:pointer;"><area shape="poly" coords="' + roomData[1] + '"></map>').appendTo('#containerWorld');
					$('<div id="gameRoom"></div>').appendTo('#containerWorld');
					$('<img src="' + roomData[0] + '" usemap="#map">').appendTo('#gameRoom');
				});
	
				/*
					Defaults Config
				*/
				$(config).find('defaults').each(function () 
				{
					var localConfig = $(this).text().split ( "|" );
					sessionData[c]["startX"] = localConfig[0];
					sessionData[c]["startY"] = localConfig[1];
				});
				
				console.log(sessionData[c]["startY"]);
				
				/*
					Create default player
				*/
				$('<div id="myAvatar" class="avatar normal" style="top:' + sessionData[c]["startX"] + 'px; left:' + sessionData[c]["startY"] + 'px;"></div>').appendTo('#gameRoom');
				$( "#myAvatar" ).css('background-image', 'url(static/sprites/' + sprite + '/' + selectedAvatar + ')');
				$('<div class="username orange">' + myName + '</div>').appendTo('#myAvatar');
				$('<div id="mybubble" class="bubble"></div>').appendTo('#myAvatar');
				
				allowInput = true;
				return 1;
			 }
		});
		
		$.ajax({
			url: siteURL + '/core/ac.online.php',
			cache: false,
			success: function(response)
			{
				avatars = response.split ( "," );
				$.each(avatars, function(k, v)
				{
					tr = v.split( "|" );
					
					if (typeof tr[1] !== 'undefined')
					{
						$('<div id="'+ $.trim(tr[1]) +'" cName="' + $.trim(tr[0]) + '" class="avatar normal" style="top:'+tr[3]+'px; left:'+tr[2]+'px;"></div>').appendTo('#gameRoom');
						$( "#"+ $.trim(tr[1]) +"" ).css('background-image', 'url(static/sprites/' + sprite + '/'+ $.trim(tr[4]) +')');
						$('<div id="username_' + $.trim(tr[0]) + '" class="username">' + $.trim(tr[0]) + '</div>').appendTo('#'+ $.trim(tr[1]) +'');
						$('<div id="' + $.trim(tr[1]) + '_chat" class="bubble" ></div>').appendTo('#'+ $.trim(tr[1]) +'');
						
						$("body").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", "#" + tr[1] + "", function(e)
						{ 
							$(this).removeClass( "right left" );
							$(this).addClass( "normal" );
						});
					}
				});
			}
		});
	}
	
	return 0;
}	

/*
	Configure Login
*/

$( "#loginButton" ).click(function() 
{
	var username = $("#loginInput").val();
	if ($.trim(username) != null && $.trim(username) != "")
	{
		$.ajax({
			type: 'POST',
			url: siteURL + '/core/ac.login.php',
			data: {uname: username, sprite: selectedAvatar},
			success:function(response)
			{
				res = $.trim(response);
				switch(res)
				{
					case "1":
					{
						$("#loginWorld").hide();
						$("#containerWorld").show();
						$("#hud").show();
						$("#uibar").show();
						
						loadRoom("lobby");
						users_poll();
						myName = username; 
						
						$("#popdown").prepend("<div class=\"message\"><div class=\"submitter system\">[SYSTEM]</div><div class=\"msg\">" + welcomeMSG + "</div>");
						
						sfx_newMessage.play();
						
						if (autolog == 1)
						{
							pd = true;
							$( "#popdown" ).slideDown( "fast", function() {});
						}
						
						break;
					}
				}	
			}
		});		
	}
});

function detectmob() {
   if(window.innerWidth <= 800 && window.innerHeight <= 600) {
     return true;
   } else {
     return false;
   }
}

/*
	Configure Worlds
*/

$(function() 
{
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 window.location.href = 'documents/mobile.html';
	}
	
	$('body').on('click', '.map area', function(e)
	{
		if (allowInput && allowMove)
		{
			allowMove = false;
			var offset = $('#myAvatar').offset();
			var parentOffset = $(this).parent().offset();
			
			var posx = 0; 
			var posy = 0; 
			
			if (!e) 
			{
				e = window.event; 
				
				if (e.pageX || e.pageY)
				{ 
					posx = e.pageX - 30; 
					posy = e.pageY - 80; 
				} 
			}
			else if (e.clientX || e.clientY)
			{ 
				posx = e.clientX + document.body.scrollLeft 
				+ document.documentElement.scrollLeft - 30; 
				posy = e.clientY + document.body.scrollTop 
				+ document.documentElement.scrollTop - 80; 
			}
			
			if (posx > offset.left - parentOffset.left)
			{
				$( "#myAvatar" ).removeClass( "normal left" );
				$( "#myAvatar" ).addClass( "right" );
				$( "#myAvatar" ).css('background-image', 'url(static/sprites/' + sprite + '/' + selectedAvatar + ')');
			}
			else
			{
				$( "#myAvatar" ).removeClass( "normal right" );
				$( "#myAvatar" ).addClass( "left" );		
				$( "#myAvatar" ).css('background-image', 'url(static/sprites/' + sprite + '/' + selectedAvatar + ')');
			}
			
			$("#myAvatar").offset({ top: posy, left: posx});
			
			$.ajax({
				type: 'POST',
				url: siteURL + '/core/ac.walk.php',
				data: {xpos: posx, ypos: posy, token: myToken},
				success:function(response)
				{
					// done
				}
			});
			
			sfx_click.play();
		}
	});
	
	/*
		To run when a transition ends
	*/
	$("body").on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", "#myAvatar", function(e)
	{
		$( this ).removeClass( "right left" );
		$( this ).addClass( "normal" );
		
		$( "#myAvatar" ).css('background-image', 'url(static/sprites/' + sprite + '/' + selectedAvatar + ')');
		allowMove = true;
	});
	
	$(window).bind("beforeunload", function() 
	{ 
		if (allowInput)
		{
			$.ajax({
				type: 'POST',
				url: siteURL + '/core/ac.quit.php',
				data: {token: myToken},
				success:function(response)
				{
					// done
				}
			});		
		}
	})
	
	/*
		Avatar Selection
	*/
	
	$( ".sel_avatar" ).click(function() 
	{
		$( ".sel_avatar" ).each(function() 
		{
			$( this ).addClass( "gray" );
		});
		
		$( this ).removeClass( "gray" );
		
		selectedAvatar = $(this).attr("id");
	});
	
	/*
		Polls
	*/
	
	var event_poll = setInterval(events_poll, 3000);
	var user_poll = setInterval(users_poll, 6000);
	var chats_poll = setInterval(chat_poll, 2000);
});
