<?php
	define('WAY', '../db/');
	require_once '../db/db.php';
	
	var_dump($_FILES);
	var_dump($_GET);
	var_dump($_POST);
	$file = $_FILES["file"];
	$file_name = $file['name'];
	$file_tmp = $file['tmp_name'];
	$file_size = $file['size'];
	$file_error = $file['error'];
	if($file_error == 0){
		$cnt = getAndUpCounter();	
		$destination = '../videos/' . $file_name;
		move_uploaded_file($file_tmp, $destination);
		pushVideoWay($cnt, $destination);

		$file = $_FILES["preview"];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
		if($file_error == 0){
			$destination = '../preview/' . $cnt . '.png';
			move_uploaded_file($file_tmp, $destination);
		}

		$name = $_POST['title'];
		$description = $_POST['description'];

		$config_file = fopen("../config/$cnt.conf", "w");
		$cfw = fwrite($config_file, "nameALGSTD!24$name!HCRGMKARS%!descriptionALGSTD!24$description!HCRGMKARS%!likesALGSTD!240!HCRGMKARS%!dislikesALGSTD!240!HCRGMKARS%!viewsALGSTD!240");
		$cl = fclose($config_file);
	}

?>	