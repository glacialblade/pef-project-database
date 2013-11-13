<?php
//include '../../../secure/.dblogin.inc';
session_start();
//echo $_SESSION['user'];
//provide facilities to change password

//check if the old password is correct then give the signal for the next input box
?>

<form id="changepasswordform" action="snippets/confirmpasswordchange.php">
<table id="table_area">
<tr><td>OLD PASSWORD:</td><td><input type="password" name="oldpass"></td><td><div id="oldpass"></div></td></tr>
<tr><td>NEW PASSWORD:</td><td><input type="input" name="newpass" value="minimum of 8 characters"></td><td><div id="newpass"></div></td></tr>
<tr><td>CONFIRM NEW PASSWORD:</td><td><input type="input" name="confirmpass"></td><td><div id="confirmpass"></div></td></tr>
<tr><td colspan="3"><input type="submit" id="changepasswordbtn"></td></tr>
</table>
</form>

<script>
$(document).ready(function () {
	$("input#changepasswordbtn").hide().attr("disabled", "disabled");
	$("input[name='newpass']").attr("disabled", "disabled");
	$("input[name='newpass']").val('minimum of 8 characters');
	$("input[name='newpass']").css('background-color','#eee');
	$("input[name='confirmpass']").attr("disabled", "disabled");
	$("input[name='confirmpass']").val('retype new password');
	$("input[name='confirmpass']").css('background-color','#eee');
	
	$("input[name='oldpass']").keyup(function(){
		if($(this).val() != ''){
			$("#oldpass").html("<img src='images/ajax-loader.gif'>");
			$.post("snippets/check_password.php",{
				username: "<?php echo $_SESSION['user']; ?>",
				password: $(this).val()}, function(data){
					if(data){
						$("#oldpass").html("<img src='images/check-mark-icon.png'>");
						$("input[name='newpass']").removeAttr("disabled");
						$("input[name='newpass']").val('');
						$("input[name='newpass']").css('background-color','#fff');
						$("input[name='newpass']").attr("type", "password");
					}else{
						$("#oldpass").html("<img src='images/x-mark-icon.png'>");
						$("input[name='newpass']").attr("disabled", "disabled");
						$("input[name='newpass']").val('minimum of 8 characters');
						$("input[name='newpass']").css('background-color','#eee');
						$("input[name='newpass']").attr("type", "input");
					}
			});
			$("#newpass").html("");
			$("#confirmpass").html("");
			$("input[name='confirmpass']").css('background-color','#eee');
			$("input[name='confirmpass']").val('retype new password');
			$("input[name='confirmpass']").attr("disabled", "disabled");
			$("input[name='confirmpass']").attr("type", "input");
			$("input#changepasswordbtn").hide().attr("disabled", "disabled");
		}else{
			$("#oldpass").html("");
		}
	});
	
	$("input[name='newpass']").keyup(function(){
		if($(this).val().length > 7){
			$("input[name='confirmpass']").removeAttr("disabled");
			$("input[name='confirmpass']").css('background-color','#fff');
			$("input[name='confirmpass']").val('');
			$("#newpass").html("<img src='images/check-mark-icon.png'>");
			$("input[name='confirmpass']").attr("type", "password");
		}else{
			$("input[name='confirmpass']").attr("disabled", "disabled");
			$("input[name='confirmpass']").css('background-color','#eee');
			$("input[name='confirmpass']").val('retype new password');
			$("#newpass").html("<img src='images/x-mark-icon.png'>");
			$("input[name='confirmpass']").attr("type", "input");
		}
		$("#confirmpass").html("");
		$("input#changepasswordbtn").hide().attr("disabled", "disabled");
	});
	$("input[name='confirmpass']").keyup(function(){
		if($(this).val() == $("input[name='newpass']").val()){
			$("#confirmpass").html("<img src='images/check-mark-icon.png'>");
			$("input#changepasswordbtn").show().removeAttr("disabled");
		}else{
			$("#confirmpass").html("<img src='images/x-mark-icon.png'>");
			$("input#changepasswordbtn").hide().attr("disabled", "disabled");
		}
	});
	$( "#changepasswordform" ).submit(function( event ) {
		event.preventDefault();
		var $form = $( this ),
		newpass = $form.find( "input[name='confirmpass']" ).val(),
		username = "<?php echo $_SESSION['user']; ?>",
		url = $form.attr( "action" );
		var posting = $.post( url, { newpassword: newpass, user: username } );
		posting.done(function( data ) {
			if(data > 0){
				$("#table_area").html("<tr><td>password change successful, please log-in</td></tr><tr><td><img src='images/ajax-loader.gif'></td></tr>");
			}else{
				$("#table_area").html("<tr><td>there was an error while processing request, please log-in again</td></tr><tr><td><img src='images/ajax-loader.gif'></td></tr>");
			}
			setTimeout(function(){window.location.href = "home";}, 3000);
		});
	});
});
</script>

<?php
//include '../../../secure/.dbclose.inc';
?>