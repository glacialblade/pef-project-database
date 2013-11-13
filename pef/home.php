<?php

include '../../../secure/.dblogin.inc';
include 'snippets/check_identity.php';
session_start();

//load basic basic information on landing page (navigation, welcome note, category/grant report, list of beneficiaries, notifications, funding type by island groups)

?>

<!DOCTYPE html>

<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script>
$(document).ready(function () {
	initialize();
});
</script>
<link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>
<div id="dialog"><table width="100%" height="100%"><tr><td id="dialogtitle">dialogbox title</td><td width="10px"><a href="#" id="dialogclose">close</a></td></tr><tr><td colspan="2" id="dialogcontent" height="200">dialog content</td></tr></table></div>
<div id="shadow" style="background-image:url(images/shade1x1.png)"></div>
<div id="container">
<div id="header">
<div class="logo">
<a href="home"><img src="#" alt="PEF LOGO" height="30" width="400"></a>
</div>
<div class="title">
Project Information Database
</div>
</div>

<div id="navigation">
<div id="left_nav">
<?php
	if($_SESSION['lvl'] >= 5){
		echo '<div class="left-btn" id="users_btn"><a href="users">users</a></div>';
	}
?>
<div class="left-btn" id="search_btn">search</div><div class="left-btn" id="help_btn">help</div><div class="left-btn" id="backup_btn">backup</div><div class="left-btn" id="restore_btn">restore</div><div class="user"><?php echo $_SESSION['access'] ?></div></div>
<div id="user_menu"><ul><li id="changepassword">change password</li><li id="logout">log out</li></ul></div>
<div id="right_nav"><div class="right-btn" id="proponents_btn">proponents</div><div class="right-btn" id="projects_btn">projects</div></div>
</div>
<div id="content">
<div id="projects">area for projects</div>
<div id="households">area for households</div>
<div id="notifications">area for notifications</div>
<div id="groups">area for groups</div>
</div>
<div id="footer">
<?php include 'parts/footer.htm'; ?>
</div>
</div>
</body>
</html>

<?php

include '../../../secure/.dbclose.inc';

?>