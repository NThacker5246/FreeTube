<!DOCTYPE html>
	<html>
		<head>
			<title>FreeTube Analytics</title>
			<meta charset="utf-8">
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="/style/styleAnalytics.css">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
		</head>

	<?php if(!empty($_GET["num"])):?>

		<body>
			<?php 
				//$user = json_decode(file_get_contents("../accounts/" . $_COOKIE['name'] . ".conf"));
				$video = file_get_contents("../config/" . $_GET["num"] . ".conf");
				$params = explode("!HCRGMKARS%!", $video);
			?>

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

				</div>
				<h1><?=$_COOKIE['name']?></h1>
				<h2>Most popular videos:</h2>
				<h3>Video: <?=explode("ALGSTD!24", $params[0])[1]?></h3>
				<ul>
					<li>Views: <?=explode("ALGSTD!24", $params[4])[1]?></li>
					<li>Likes: <?=explode("ALGSTD!24", $params[2])[1]?></li>
					<li>Dislikes: <?=explode("ALGSTD!24", $params[3])[1]?></li>
				</ul>
				<?php
				$LPV = (intval(explode("ALGSTD!24", $params[2])[1]) - intval(explode("ALGSTD!24", $params[3])[1])) / explode("ALGSTD!24", $params[4])[1];
				?>

				<h5>LPV: <?=$LPV?></h5>
				<p>LPV (likes per view) - a coefficient, what uses to check - if video make good or topic was the useful. LPV counts using that formula:</p>
				<pre>LPV = (likes - dislikes) / views</pre>
				Go To <a href="./index.php">Analitics</a>
				Go To <a href="../studio/index.php">Studio</a>
			</div>
		</body>
	</html>

	<?php else: ?>

		<body>

			<?php 
				$user = json_decode(file_get_contents("../accounts/" . $_COOKIE['name'] . ".conf"));
			?>
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
						<img class="profileIcon" width="25" height="25" src="../ico/profileicon.png"/>
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

				</div>
				<h1><?=$_COOKIE['name']?></h1>
				<h2>Most popular videos:</h2>
				<?php
				$VIEWER = [0];
				?>

				<table border="1px solid black">
					<tr>
						<td>Video name</td>
						<td>Views</td>
						<td>Likes/Dislikes</td>
					</tr>

					<?php foreach($user->videoCreated as $link): ?>
						<?php
						$video = file_get_contents("../config/" . $link . ".conf");
						$params = explode("!HCRGMKARS%!", $video);
						?>
						<tr>
							<?php
								if (intval(explode("ALGSTD!24", $params[4])[1]) > $VIEWER[0]) {
									$VIEWER = [intval(explode("ALGSTD!24", $params[4])[1]), explode("ALGSTD!24", $params[0])[1], $link];
								}
							?>
							<td><a href="./?num=<?=$link?>"><?=explode("ALGSTD!24", $params[0])[1]?></a></td>
							<td><?=explode("ALGSTD!24", $params[4])[1]?></td>
							<td><?=explode("ALGSTD!24", $params[2])[1]?>/<?=explode("ALGSTD!24", $params[3])[1]?></td>
						</tr>
					<?php endforeach ?>
				</table>
				<h3>Your video, that got a max views: <a href="/watch.php?video=<?=$VIEWER[2]?>"><?=$VIEWER[1]?></a>, with total views <?=$VIEWER[0]?></h3>
				Go To <a href="../studio/index.php">Studio</a>
			</div>
		</body>
	</html>
	<?php endif?>