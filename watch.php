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
		<div class="header" id="header"><h2>FreeTube</h2></div>
		<div class="video-seen">
			<div class="video">
				<video src="<?=$src?>" autoplay="" id="player">
				</video>
				<div class="controlls">
					<div id="pause"></div>
					<div class="scroll" id="pos">
						<div class="polzunok" id="ppos"></div>
					</div>

					<select id="playBackRate">
						<option value="0.25">0.25</option>
						<option value="0.5">0.5</option>
						<option value="0.75">0.75</option>
						<option value="1">1</option>
						<option value="1.25">1.25</option>
						<option value="1.5">1.5</option>
						<option value="1.75">1.75</option>
						<option value="2">2</option>
					</select>

					<div id="fullscreen"></div>
				</div>
			</div>
		</div>
		<div class="next-videos"></div>
	</div>
	<script type="text/javascript" src="controlls.js"></script>
</body>
</html>