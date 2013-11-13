<?php
include '../../../secure/.dblogin.inc';
header("Cache-Control: no-cache");
//check if password is correct
hash('ripemd160', 'The quick brown fox jumped over the lazy dog.');

$sql = "SELECT username FROM users_tbl WHERE username='".$_POST['username']."' AND password='".hash('sha256', $_POST['password'])."' LIMIT 1";
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);
if($row){
	echo true;
}else{
	echo false;
}


//echo 'username: '.$_POST['username']. 'password: '. $_POST['password'];

include '../../../secure/.dbclose.inc';
?>