<?php
	$fdata = file_get_contents("./db/table.json");
	$data = json_decode($fdata);
?>

<!DOCTYPE html>
<html>
<head>
	<title>FreeTube</title>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/style/styleHomepage.css">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
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

			<a href="/profile.php" class="headerBubble3">
				<img class="profileIcon" width="25" height="25" src="ico/profileicon.png"/>
			</a>

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

		<div class="main-videos">
			<?php
			for ($i=1; $i < $data->count; $i++) { 
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
		<!-- <div>Link to profile <a href="profile.php">page</a></div> -->
	</div>
</body>
</html>