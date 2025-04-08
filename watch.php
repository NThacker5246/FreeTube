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
	<link rel="stylesheet" type="text/css" href="style/styleVideo.css" id="styles">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
	<link rel="icon" href="favicon.ico" >
	<link rel="stylesheet" type="text/css" href="/style/" id="linker">
</head>

<body>
	
	<div class="container">
		<div class="header" id="header">
			<a href="/" class="headerBubble">
                <span class="bubbleText">FreeTube</span>
                <span class="bubbleTextsh">FreeTube</span>
			</a>
			<div class="headerBubble2" id="headerBubble">
				<div class="slider" id="themeSelecter">
					<div class="bubble" style="background-color:rgb(255, 255, 255);"></div>
					<div class="bubble" style="background-color:rgb(31, 31, 31);"></div>
					<div class="bubble" style="background-color:rgb(81, 107, 225);"></div>
					<div class="bubble" style="background-color:rgb(87, 195, 137);"></div>
					<div class="bubble" style="background-color: #FF33A8;"></div>
					<div class="bubble" style="background-color: #FFBD33;"></div>
					<div class="bubble" style="background-color: #33FFF0;"></div>
					<div class="bubble" style="background-color: #A833FF;"></div>
				</div>
			</div>

	<script>
		const slider = document.getElementById("themeSelecter");
        let index = 0;
        const totalBubbles = document.querySelectorAll(".bubble").length;
        const bubbleWidth = 26;

		slider.addEventListener("wheel", (event) => {
			event.preventDefault(); // Prevent default page scrolling
			index += event.deltaY > 0 ? 1 : -1;
			index = Math.max(0, Math.min(index, totalBubbles - 3));
			slider.style.transform = `translateX(${-index * bubbleWidth}px)`;
		});
    </script>

		<!--	<select class="headerBubble" id="styleChanger">
				<option value="0">GiMaker version</option>
				<option value="1">NThacker version</option>
			</select> -->
		</div>
		<div class="video-seen">
			<div class="video">
				<video src="<?=$src?>" autoplay="" id="player" class="videoplay"></video>
				<video src="<?=$src?>" autoplay="" id="playerBlur" class="videoblur"></video>
			</div>
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
		<div class="titleV" id="titleV">

			<div class="titleV2">
				<?php
					$conf = file_get_contents("./config/$num.conf");
					$kw = explode("!HCRGMKARS%!", $conf);
					$text = trim(explode("ALGSTD!24", $kw[0])[1]);
					echo "$text";
				?>
			</div>

			<div class="LikeDislike">
				<div id="like">Like</div>/<div id="dislike">Dislike</div>/
				<?php  
					//$conf = file_get_contents("./config/$num.conf");
					//$kw = explode("!HCRGMKARS%!", $conf);
					//var_dump($kw);
					//var_dump($kw);
					$text = trim(explode("ALGSTD!24", $kw[5])[1]);
				?>
				<div>Link to authory: <a href="profile.php?chan=<?=$text?>"><?=$text?></a></div>
			</div>
			<div id="views" class="views">Views: </div>	

			<pre class="description" id="desc">
				
<?php
					//$conf = file_get_contents("./config/$num.conf");
					//$kw = explode("!HCRGMKARS%!", $conf);
					$text = trim(explode("ALGSTD!24", $kw[1])[1]);
					echo "$text";
				?>
				
			</pre>

		</div>
		<div class="next-videos" id="next">
			<?php
			for ($i=1; $i < $data->count; $i++) { 
				if($i == intval($num)) continue;
				$conf = file_get_contents("./config/$i.conf");
				$kw = explode("!HCRGMKARS%!", $conf);
				$name = explode("ALGSTD!24", $kw[0])[1];
				echo "
				<a href=\"/watch.php?video=$i\" class=\"card\">
					<div>
						<img src=\"/preview/$i.png\" width=\"300px\" height=\"168.75px\" class=\"cardvid\">
						<div class=\"cardtext\">$name</div>
					</div>
				</a>";
			}
			?>
		</div>
		<div class="commentBubble" id="commentBubble">
			<div class="comments">
				<input type="text" name="comment" id="inCom" class="commentInput">
				<div id="commRES" class="commentText"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		const i = parseInt(<?=$num?>);
	</script>
	<script type="text/javascript" src="controlls.js"></script>
	<script type="text/javascript" src="alike.js"></script>
	<script type="text/javascript" src="comment.js"></script>
	<script type="text/javascript" src="themes.js"></script>
	<script type="text/javascript" src="styles.js"></script>
</body>
</html>