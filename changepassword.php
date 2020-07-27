<?php

require "conn.php";

$username = $_POST[username];
$password = $_POST[password];
$newpassword = $_POST[newpassword];
$mysql_qry = "select pw from account where login = '$username'";
$result = mysqli_query($con, $mysql_qry);
$row = mysqli_fetch_assoc($result);

if ($row['pw'] == $password){
	$mysql_qry = "update account set pw = '$newpassword' where pw = '$password'";
	mysqli_query($con, $mysql_qry);
	echo "done";
}else{
	echo "pw";
}

?>