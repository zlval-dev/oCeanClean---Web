<?php

require "conn.php";

$username = $_POST[username];
$password = $_POST[password];
$mysql_qry = "select * from account where login = '$username' and pw = '$password'";
$result = mysqli_query($con, $mysql_qry);
$assoc = mysqli_fetch_assoc($result);
$admin = $assoc['admin'];

if (mysqli_num_rows($result) > 0)
{
	echo $admin;
}
else
{
	echo "fail";
}

?>