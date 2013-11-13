<?php

include '../../secure/.dblogin.inc';
include 'snippets/check_identity.php';
session_start();
if($_SESSION['lvl'] < 5){
	header("location:home");
}

//load all users into it's window
//provide options on the other side
//detect when changes have been made and offer to save it
//when moving to another page or user without saving, ask to confirm first
//creating a user empties the boxes
//deleting the user just suspends the account

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
<div id="left_nav"><div class="left-btn" id="users_btn">users</div><div class="left-btn" id="search_btn">search</div><div class="left-btn" id="help_btn">help</div><div class="left-btn" id="backup_btn">backup</div><div class="left-btn" id="restore_btn">restore</div><div class="user"><?php echo $_SESSION['access'] ?></div></div>
<div id="user_menu"><ul><li id="changepassword">change password</li><li id="logout">log out</li></ul></div>
<div id="right_nav"><div class="right-btn" id="adduser_btn">add user</div></div>
</div>
<div id="content">
<!--
<div id="projects">area for projects</div>
<div id="households">area for households</div>
<div id="notifications">area for notifications</div>
<div id="groups">area for groups</div>
-->
<div id="users_list">
<center>
<p>USERS LIST</p>
<div id="users_table">
<table border="1">
<tr><td>User</td><td>Access Level</td></tr>
<?php

$sql = "SELECT username AS u, access_label AS a
		FROM users_tbl
		JOIN access_tbl
		ON users_tbl.fk_access_level = access_tbl.access_level";
		
$result = mysql_query($sql);
if($result){
	while($row = mysql_fetch_array($result)){
		echo "<tr><td>".$row['u']."</td><td> ".$row['a']."</td></tr>";
	}
	
}else{
	echo mysql_error();
}
?>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

</table>
</div>
</center>
</div>
<div id="edit_area">area for editing details</div>
</div>
<div id="footer">
<?php include 'parts/footer.htm'; ?>
</div>
</div>
</body>
</html>

<?php

include '../../secure/.dbclose.inc';

?>