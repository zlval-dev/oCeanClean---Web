<?php

require_once 'conn.php';
$query = "select * from reportlitter where remove='false'";
$result = mysqli_query($con, $query);
echo mysqli_num_rows($result)."<br/>";;
while($assoc = mysqli_fetch_assoc($result)){
	echo $assoc['lang']."<br/>";
	echo $assoc['longi']."<br/>";
	echo $assoc['category']."<br/>";
	echo $assoc['description']."<br/>";
	$id_photo = $assoc['id_photo'];
	$query_photo = "select * from photo where id='$id_photo'";
	$result_photo = mysqli_query($con, $query_photo);
	$assoc_photo = mysqli_fetch_assoc($result_photo);
	echo $assoc_photo['url']."<br/>";
}

?>