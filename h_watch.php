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
	<link rel="stylesheet" type="text/css" href="style/legacy.css">
</head>
<body>
	<div class="container">
		<div class="header" id="header">
			<h1 style="margin: 0px;">FreeTube</h1>
			<p style="margin-left: 30px; font-size: 20px; margin-top: 10px;">FreeTube - free, open source and the best analog of YT <a style="position: absolute; right: 5px;" href="http://github.com/NThacker5246/FreeTube">Source Code</a> </p>
		</div>
		<div class="video-seen">
			<div class="video">
				<video src="<?=$src?>" autoplay="" id="player">
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
			<div id="like">Like</div>/<div id="dislike">Dislike</div>/
			<?php  
				$conf = file_get_contents("./config/$num.conf");
				$kw = explode("!HCRGMKARS%!", $conf);
				//var_dump($kw);
				//var_dump($kw);
				$text = trim(explode("ALGSTD!24", $kw[5])[1]);
			?>
			<div>Link to authory: <a href="profile.php?chan=<?=$text?>"><?=$text?></a></div>
		</div>
		<div id="views">Views: </div>	
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
						<img src=\"/preview/$i.png\" width=\"300px\" height=\"168.75px\">
						<p>$name</p>
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