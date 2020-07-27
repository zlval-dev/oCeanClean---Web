<?php

require "conn.php";

$rusername = $_POST[rusername];
$email = $_POST[email];
$password = $_POST[password];
$confirmPassword = $_POST[confirmPassword];
$mysql_qry = "select * from account where login = '$rusername'";
$result = mysqli_query($con, $mysql_qry);

if (mysqli_num_rows($result) > 0)
{
	echo "id";
}
else
{
	$mysql_qry = "select * from account where email = '$email'";
	$result = mysqli_query($con, $mysql_qry);
	if(mysqli_num_rows($result) > 0){
		echo "email";
	}
	else{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			if ($password == $confirmPassword){
				$mysql_qry = "insert into account (login, pw, email) values ('$rusername', '$password', '$email')";
				mysqli_query($con, $mysql_qry);
				echo "done";
			}
			else{
				echo "pw";
			}
		}else{
			echo "format";
		}
	}
}

?>