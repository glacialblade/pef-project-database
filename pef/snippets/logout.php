<?php
include '../secure/.dblogin.inc';

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

$sql = "UPDATE users_tbl SET phpsession=NULL WHERE user_id='".$_SESSION['user_id']."' LIMIT 1";
mysql_query($sql) or die(mysql_error());

// Unset all of the session variables.
$_SESSION = array();

// Finally, destroy the session.
session_destroy();
echo "you are being logged out, please wait";
echo "<img id='loading-image' src='images/ajax-loader.gif' alt='Loading...' />";

include '../secure/.dbclose.inc';
?>
<script>
$(document).ready(function () {
	setTimeout(function() {
		window.location.href = "index";
	}, 2000);
});
</script>