<?php  
	define('WAY', '../accounts/');
	require_once 'db/account.php';
	$nickname = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];
	$pwd = $_POST['pwd'];

	$dt = getUser($pwd, $nickname, $email, $number);
	//echo "THere";
	// /var_dump($dt);
	if($dt == false){
		echo "Unregisted";
	}

	session_start();
	setcookie("Password", $pwd, time() + 0x7FFFFFFF, "/");
	$_SESSION['user'] = $dt->name;
	header("Location: /profile.php");

?>