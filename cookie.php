<?php

$num = $_GET['num'];
$type = $_GET['type'];

switch ($type) {
	case 'style':
		setcookie("style", $num, time() + 0x7FFFFFFF, "/");
		echo "style";
		break;

	case 'theme':
		setcookie("theme", $num, time() + 0x7FFFFFFF, "/");
		echo "theme";
		break;
	
	default:
		# code...
		break;
}