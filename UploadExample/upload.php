<?php
	require_once 'dbDetails.php';
	$upload_path = 'uploads/';
	$server_ip = gethostbyname(gethostname());
	$upload_url = 'http://'.$server_ip.'/UploadExample/'.$upload_path;
	$response = array();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['name']) and isset($_FILES['image']['name'])){
			$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die('unable to connect to database ');
			$name = $_POST['name'];
			$fileinfo = pathinfo($_FILES['image']['name']);
			$extension = $fileinfo['extension'];
			$file_url = $upload_url . getFileName() . '.'.$extension;
			$file_path = $upload_path . getFileName() . '.'.$extension;
			try{
				move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
				$sql = "insert into photo(url) values ('$file_url')";
				if(mysqli_query($con, $sql)){
					$response['error'] = false;
					$response['url'] = $file_url;
					$response['name'] = $name;
				}
			}catch(Exception $e){
				$response['error'] = false;
				$response['message'] = $e->getMessage();
			}
			mysqli_close($con);
		}
		else{
			$response['error'] = true;
			$response['message'] = 'please choose a file';
		}
		echo json_encode($response);
	}

	function getFileName(){
		$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die('unable to connect to database ');
		$sql = "select max(id) as id from photo";
		$result = mysqli_fetch_array(mysqli_query($con, $sql));
		mysqli_close($con);
		if($result['id']==null){
			return 1;
		}else{
			return ++$result['id'];
		}
	}
	?>