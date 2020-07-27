<?php

require "conn.php";

$username = $_POST[username];
$latitude = $_POST[latitude];
$longitude = $_POST[longitude];
$category = $_POST[category];
$commentNotes = $_POST[commentNotes];

$mysql_qry = "select id from photo order by id desc limit 1";
$result = mysqli_query($con, $mysql_qry);
$row = mysqli_fetch_assoc($result);
$done = $row['id'];

$mysql_qry = "insert into reportlitter (category, description, lang, longi, id_photo) values ('$category', '$commentNotes', '$latitude', '$longitude', '$done')";
$result_qry = mysqli_query($con, $mysql_qry);

if($result_qry){
	echo "done";
}else{
	echo "fail";
}

?>