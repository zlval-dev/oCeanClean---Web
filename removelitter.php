<?php

require "conn.php";

$username = $_POST[username];
$urlremove = $_POST[urlremove];

$mysql_qry = "select * from photo where url='$urlremove'";
$result = mysqli_query($con, $mysql_qry);
$assoc = mysqli_fetch_assoc($result);

$mysql_qry = "update reportlitter set remove=true where id_photo=".$assoc['id'];
$result = mysqli_query($con, $mysql_qry);

if($result){
	echo "done";
}else{
	echo "fail";
}

?>