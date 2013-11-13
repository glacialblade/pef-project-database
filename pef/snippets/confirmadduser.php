<?php
include '../../../secure/.dblogin.inc';
header("Cache-Control: no-cache");

//password encryption
$pass = hash('sha256', $_POST['password']);

$sql = "INSERT INTO users_tbl (username, password, fk_access_level, position, email)
VALUES ('".$_POST['username']."', '".$pass."', '".$_POST['access']."', '".$_POST['position']."', '".$_POST['email']."')";
//echo $sql;
if(mysql_query($sql)){
	echo true;
}else{
	echo false;
}

//$sql = "UPDATE users_tbl SET password='".hash('sha256', $_POST['newpassword'])."', phpsession=NULL WHERE username='".$_POST['user']."' LIMIT 1";
//mysql_query($sql);
//echo mysql_affected_rows();
include '../../../secure/.dbclose.inc';
?>