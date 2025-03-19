<?php
	define('WAY', 'db/');

	require_once 'db/db.php';
	$num = $_GET['video'];

	$src = getVideoWay(intval($num));

	$fdata = file_get_contents("./db/table.json");
	$data = json_decode($fdata);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Watch videos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/styleVideo.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="header" id="header">
			<div class="headerBubble">
                <span class="bubbleText">FreeTube</span>
                <span class="bubbleTextsh">FreeTube</span>
            </div>
		</div>
		<div class="video-seen">
			<div class="video">
				<video src="<?=$src?>" autoplay="" id="player" class="video">
				</video>
				<div class="controlls" id="controll">
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
		<div class="description" id="desc">
			<pre>
				<br>
<?php
					$conf = file_get_contents("./config/$num.conf");
					$kw = explode("!HCRGMKARS%!", $conf);
					$text = trim(explode("ALGSTD!24", $kw[1])[1]);
					echo "$text";
				?>
			</pre>
		</div>
		<div class="LikeDislike">
			<div id="like">Like</div>/<div id="dislike">Dislike</div>
		</div>
		<div id="views" class="views">Views: </div>	
		<div class="next-videos" id="next">
			<?php
			for ($i=1; $i < $data->count; $i++) { 
				if($i == intval($num)) continue;
				$conf = file_get_contents("./config/$i.conf");
				$kw = explode("!HCRGMKARS%!", $conf);
				$name = explode("ALGSTD!24", $kw[0])[1];
				echo "
				<a href=\"/watch.php?video=$i\">
					<div class=\"card\">
						<img src=\"/preview/$i.png\" width=\"300px\" height=\"168.75px\" class=\"cardvid\">
						<div class=\"cardtext\">
							<a>$name</a>
						</div>
					</div>
				</a>";
			}
			?>
		</div>
	</div>
	<script type="text/javascript">
		const i = parseInt(<?=$num?>);
	</script>
	<script type="text/javascript" src="controlls.js"></script>
	<script type="text/javascript" src="alike.js"></script>
</body>
</html>