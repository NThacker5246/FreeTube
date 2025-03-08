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
		$destination = '../videos/' . $file_name;
		move_uploaded_file($file_tmp, $destination);
		pushVideoWay(getAndUpCounter(), $destination);
	}
?>