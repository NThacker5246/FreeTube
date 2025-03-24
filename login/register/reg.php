<?php  
	define('WAY', '../../accounts/');
	require_once '../db/account.php';
	$nickname = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$pwd = $_POST['pwd'];

	$dt = addUser($pwd, $nickname, $email, $number);
	if($dt == false){
		header("Location: ./index.php");
	}

	session_start();
	setcookie("name", $nickname, time() + 0x7FFFFFFF, "/");
	$_SESSION['user'] = $nickname;
	
	header("Location: /profile.php");

?>