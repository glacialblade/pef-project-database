<?php
session_start();
//check identity ? renew session, continue with the page : send to index
//echo 'identity check sequence';
$ses = session_id();

$sql = "SELECT username FROM users_tbl WHERE user_id='".$_SESSION['user_id']."' AND phpsession='".$ses."' AND TIMESTAMPDIFF(MINUTE, timestamp, now()) < 60*4 LIMIT 1";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
if($row){
	session_regenerate_id();
	$ses = session_id();
	$sql = "UPDATE users_tbl SET phpsession='".$ses."', timestamp=now() WHERE user_id='".$_SESSION['user_id']."' LIMIT 1";
	mysql_query($sql);
}else{
	header('Location: index');
	echo 'your session has expired, you are being redirected';
?>
	
<script>
	$(document).ready(function () {
		setTimeout(function() {
			window.location.href = "index";
		}, 2000);
	});
</script>

<?php

}

?>