<?php
session_start();
//provide facility to add user

//if username is good : enable password box
//if username is not good : disable the password box
?>

<form id="addnewuserform" action="snippets/confirmadduser.php">
<table id="table_area">
<tr><td>POSITION:</td><td><input type="input" name="position"></td><td><div id="position"></div></td></tr>
<tr><td>USERNAME:</td><td><input type="input" name="username" value=""></td><td><div id="username"></div></td></tr>
<tr><td>PASSWORD:</td><td><input type="password" name="password"></td><td><div id="password"></div></td></tr>
<tr><td>CONFIRM PASSWORD:</td><td><input type="password" name="confirmpassword"></td><td><div id="confirmpassword"></div></td></tr>
<tr><td>EMAIL ADDRESS:</td><td><input type="input" name="email"></td><td><div id="email"></div></td></tr>
<tr><td>ACCESS LEVEL:</td><td><input type="radio" name="access" value="5">Administrator <input type="radio" name="access" value="4">Moderator<br/>
<input type="radio" name="access" value="3">Encoder <input type="radio" name="access" value="2">Finance<br/>
<input type="radio" name="access" value="1" checked="checked">Guest</td><td><div id="access"></div></td></tr>
<tr><td colspan="3"><input type="submit" id="adduserbtn"></td></tr>
</table>
</form>

<script>
$(document).ready(function () {
	var username_valid = false;
	var password_valid = false;
	var email_valid = false;
	function check_valid_fields(){
		if (username_valid && password_valid){
			if($("input[name='email']").val() == ''){
				$("input#adduserbtn").show().removeAttr("disabled");
			}else{
				if(email_valid){
					$("input#adduserbtn").show().removeAttr("disabled");
				}else{
					$("input#adduserbtn").hide().attr("disabled", "disabled");
				}
			}
		}else{
			$("input#adduserbtn").hide().attr("disabled", "disabled");
		}
	}
	$("input#adduserbtn").hide().attr("disabled", "disabled");
	
	$("input[name='username']").val('required');
	$("input[name='username']").css('background-color','#eee');
	
	$("input[name='password']").attr("type", "input");
	$("input[name='password']").attr("disabled", "disabled");
	$("input[name='password']").val('minimum of 8 characters');
	$("input[name='password']").css('background-color','#eee');
	
	$("input[name='confirmpassword']").attr("type", "input");
	$("input[name='confirmpassword']").attr("disabled", "disabled");
	$("input[name='confirmpassword']").val('retype password');
	$("input[name='confirmpassword']").css('background-color','#eee');
	
	$("input[name='username']").focusin( function(){
		if($(this).val() == 'required' || $(this).val() == ''){
			$(this).val('');
			$(this).css('background-color','#fff');
		}
	});
	
	$("input[name='username']").focusout( function(){
		if($(this).val() == 'required' || $(this).val() == ''){
			$(this).val('required');
			$(this).css('background-color','#eee');
		}
	});
	
	$("input[name='password']").focusin( function(){
		$(this).attr('type', 'password');
		if($(this).val() == 'minimum of 8 characters' || $(this).val() == '' || $(this).val().length < 8 ){
			$(this).val('');
			$(this).css('background-color','#fff');
		}
	});
	
	$("input[name='password']").focusout( function(){
		if($(this).val() == 'minimum of 8 characters' || $(this).val() == '' || $(this).val().length < 8 ){
			$(this).val('minimum of 8 characters');
			$(this).css('background-color','#eee');
			$(this).attr('type', 'input');
		}else{
			$(this).attr('type', 'password');
		}
	});
	
	$("input[name='confirmpassword']").focusin( function(){
		$(this).attr('type', 'password');
		if($(this).val() == 'retype password' || $(this).val() == '' || $(this).val().length < 8 ){
			$(this).val('');
			$(this).css('background-color','#fff');
		}
	});
	
	$("input[name='confirmpassword']").focusout( function(){
		if($(this).val() == 'retype password' || $(this).val() == '' || $(this).val().length < 8 ){
			$(this).val('retype password');
			$(this).css('background-color','#eee');
			$(this).attr('type', 'input');
		}else{
			$(this).attr('type', 'password');
		}
	});
	
	$("input[name='username']").keyup( function(){
		if($(this).val() == "" || $(this).val() == "required"){
			$("#username").html("<img src='images/x-mark-icon.png'>");
			username_valid = false;
		}else{
			$.post("snippets/check_available_username.php",{ username: $(this).val() }, function(data){
				if(data){
					$("#username").html("<img src='images/x-mark-icon.png'>");
					$("input[name='password']").attr("disabled", "disabled");
					$("input[name='password']").attr("type", "input");
					$("input[name='password']").val("minimum of 8 characters");
					$("input[name='password']").css('background-color','#eee');
					$("#password").html("<img src='images/x-mark-icon.png'>");
					$("input[name='confirmpassword']").attr("disabled", "disabled");
					$("input[name='confirmpassword']").attr("type", "input");
					$("input[name='confirmpassword']").val("retype password");
					$("input[name='confirmpassword']").css('background-color','#eee');
					$("#confirmpassword").html("<img src='images/x-mark-icon.png'>");
					username_valid = false;
				}else{
					$("#username").html("<img src='images/check-mark-icon.png'>");
					$("input[name='password']").removeAttr("disabled");
					username_valid = true;
				}
			});
		}
		check_valid_fields();
	});
	
	$("input[name='password']").keyup( function(){
		$("input[name='confirmpassword']").attr("disabled", "disabled");
		$("input[name='confirmpassword']").attr("type", "input");
		$("input[name='confirmpassword']").val("retype password");
		$("input[name='confirmpassword']").css('background-color','#eee');
		$("#confirmpassword").html("<img src='images/x-mark-icon.png'>");
		if($(this).val() == "" || $(this).val() == "minimum of 8 characters" || $(this).val().length < 8){
			$("#password").html("<img src='images/x-mark-icon.png'>");
		}else{
			$("#password").html("<img src='images/check-mark-icon.png'>");
			$("input[name='confirmpassword']").removeAttr("disabled");
		}
		check_valid_fields();
	});
	
	$("input[name='confirmpassword']").keyup( function(){
		if($(this).val() != $("input[name='password']").val()){
			$("#confirmpassword").html("<img src='images/x-mark-icon.png'>");
			password_valid = false;
		}else{
			$("#confirmpassword").html("<img src='images/check-mark-icon.png'>");
			password_valid = true;
		}
		check_valid_fields();
	});
	
	$("input[name='email']").keyup( function(){
		function IsEmail(email){
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}
		if(IsEmail($(this).val())){
			$("#email").html("<img src='images/check-mark-icon.png'>");
			email_valid = true;
		}else{
			$("#email").html("<img src='images/x-mark-icon.png'>");
			if($(this).val() == ""){
				$("#email").html("");
			}
			email_valid = false;
		}
		check_valid_fields();
	});
	
	$( "#addnewuserform" ).submit(function( event ) {
		event.preventDefault();
		var $form = $( this ),
		pass = $form.find( "input[name='password']" ).val(),
		user = $form.find( "input[name='username']" ).val(),
		pos = $form.find( "input[name='position']" ).val(),
		lvl = $form.find( "input[name='access']:checked" ).val(),
		eml = $form.find( "input[name='email']" ).val(),
		url = $form.attr( "action" );
		var posting = $.post( url, { username: user, password: pass, position: pos, access: lvl, email: eml } );
		posting.done(function( data ) {
			if(data == true){
				$("#table_area").html("<tr><td>successfully added a user<br/>this window will close automatically</td></tr><tr><td><img src='images/ajax-loader.gif'></td></tr>");
			}else{
				$("#table_area").html("<tr><td>there was an error adding user<br/>you will be redirected shortly</td></tr><tr><td><img src='images/ajax-loader.gif'></td></tr>");
			}
			setTimeout(function(){window.location.href = "users";}, 3000);
		});
	});
});
</script>

<?php

?>