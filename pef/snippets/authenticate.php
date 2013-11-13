<?php

include '../../../secure/.dblogin.inc';

function checkuser($u){
	$sql = "SELECT username FROM users_tbl WHERE username='$u'";
	$result = mysql_query($sql);
	$matchFound = mysql_num_rows($result) > 0 ? true : false;

	return $matchFound;
}

function matchpassword($u,$p){
	$pass = hash("sha256",$_POST["p"]);
	$sql = "SELECT username FROM users_tbl WHERE username='$u' AND password='$pass'";
	$result = mysql_query($sql);
	$matchFound = mysql_num_rows($result) > 0 ? true : false;
	
	return $matchFound;
}

if(checkuser($_POST["u"])){
	if(matchpassword($_POST["u"],$_POST["p"])){
		session_start();
		session_regenerate_id();
		$sql = "SELECT username AS u, access_label AS a, user_id AS i, access_level AS l FROM users_tbl INNER JOIN access_tbl WHERE username='".$_POST["u"]."' AND access_level=fk_access_level";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		echo "welcome ".$row['u']."!<br/>";
		echo "<img id='loading-image' src='images/ajax-loader.gif' alt='Loading...' />";
		$_SESSION['user']=$row['u'];
		$_SESSION['user_id']=$row['i'];
		$_SESSION['access']=$row['a'];
		$_SESSION['lvl']=$row['l'];
		$ses = session_id();
		$sql = "UPDATE users_tbl SET phpsession='".$ses."', timestamp=now() WHERE user_id='".$_SESSION['user_id']."' LIMIT 1";
		mysql_query($sql);
	}else{
		echo 'incorrect password : ';
	}
}else{
	echo 'username does not exist, please try again';
}

include '../../../secure/.dbclose.inc';

?>