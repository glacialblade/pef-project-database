<?php
include '../../secure/.dblogin.inc';
header("Cache-Control: no-cache");
$sql = "UPDATE users_tbl SET password='".hash('sha256', $_POST['newpassword'])."', phpsession=NULL WHERE username='".$_POST['user']."' LIMIT 1";
//$sql = "UPDATE users_tbl SET timestamp=now() WHERE username='".$_POST['user']."' LIMIT 1";
mysql_query($sql);
echo mysql_affected_rows();
include '../../secure/.dbclose.inc';
?>