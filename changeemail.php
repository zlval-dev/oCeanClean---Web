<?php

require "conn.php";

$username = $_POST[username];
$email = $_POST[email];
$newemail = $_POST[newemail];
$mysql_qry = "select email from account where login = '$username'";
$result = mysqli_query($con, $mysql_qry);
$row = mysqli_fetch_assoc($result);


if ($row['email'] == $email){
	if(filter_var($newemail, FILTER_VALIDATE_EMAIL)){
		$mysql_qry = "update account set email = '$newemail' where email = '$email'";
		mysqli_query($con, $mysql_qry);
		echo "done";
	}
	else{
		echo "format";
	}
}else{
	echo "email";
}

?>