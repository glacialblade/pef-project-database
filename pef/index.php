<!DOCTYPE html>
<html>

<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(document).ready(function () {

	$("#login").hide();

	function showlogin(){
		$("#login").show();
		$("#welcome_img").hide();
		$("input[type=submit]").attr("disabled", "disabled");
		$("input[type=submit]").hide();
	}
	
	$("input").keyup(function(){

			if($("input[name='username']").val().length === 0 || $("input[name='password']").val().length ===0) validated = false;
			if($("input[name='username']").val().length && $("input[name='password']").val().length) validated = true;
			
			if(validated) $("input[type=submit]").removeAttr("disabled");
			if(validated) $("input[type=submit]").show();
			
			if(validated == false) $("input[type=submit]").attr("disabled", "disabled");
			if(validated == false) $("input[type=submit]").hide();

	});

	$("#welcome_img").click(function () {
		showlogin();
	});
	
	$( "#loginForm" ).submit(function( event ) {
		event.preventDefault();
		var $form = $( this ),
		user = $form.find( "input[name='username']" ).val(),
		pass = $form.find( "input[name='password']" ).val(),
		url = $form.attr( "action" );
		var posting = $.post( url, { u: user, p: pass } );
		posting.done(function( data ) {
			$( "#prompt" ).empty().append( data );
			if($( "#prompt" ).text().match(/welcome/g)){
				setTimeout(function() {
					window.location.href = "home";
				}, 2000);
			}
		});
		$form.find( "input[name='username']" ).val('');
		$form.find( "input[name='password']" ).val('');
		$form.find( "input[type=submit]" ).hide();
		
	});
	
});
</script>
<link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>
<div id="container">
<div id="header">
<div class="logo">
<a href="#"><img src="#" alt="PEF LOGO" height="30" width="400"></a>
</div>
<div class="title">
Project Information Database
</div>
</div>

<div id="navigation">
navigation buttons
</div>
<div id="content">
<div id="welcome_img">
<img  src="#" width="100%" height="100%" alt="welcome image here, click to login">
</div>
<div id="login">
	<form action="snippets/authenticate.php" id="loginForm">
	<table width="100%" border=1>
	<tr><td>username</td><td><input type="input" name="username" id="username"></td></tr>
	<tr><td>password</td><td><input type="password" name="password" id="password"></td></tr>
	<tr><td colspan="2"><input type="submit"></td></tr>
	</table>
	</form>
</div>
<div id="prompt"></div>
</div>
<div id="footer">
<?php include 'parts/footer.htm'; ?>
</div>
</div>
</body>
</html>