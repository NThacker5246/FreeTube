<?php
	define('WAY', 'db/');

	require_once 'db/db.php';
	$num = $_GET['video'];

	$src = getVideoWay(intval($num));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Watch videos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/legacy.css">
</head>
<body>
	<div class="container">
		<div class="header"></div>
		<div class="video-seen">
			<video src="<?=$src?>" controls="" autoplay=""></video>
		</div>
		<div class="next-videos"></div>
	</div>
</body>
</html>