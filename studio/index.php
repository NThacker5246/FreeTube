
<?php
	define('WAY', '../accounts/');

	$name = $_COOKIE['name'];

	$usr = json_decode(file_get_contents(WAY . $name . ".conf"));

?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$usr->name?>'s studio</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style/styleStudio.css">
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


		<div class="stepUpload">
			<div class="bg">
				<div class="bgText">Upload</div>
			</div>
		</div>
		

		<div class="stepName">
				
		</div>


		<div class="stepBanner">
				
		</div>


		<div class="stepDescription">

		</div>


		<!--
		<p class="title-mek">Let's make a video:</p> 
		<form action="./studio.php" method="POST" enctype="multipart/form-data">
			<div class="input-item">
				<input type="file" name="file" accept="video/*" placeholder="Video (target) file" title="Target file">
				<p class="placeholder">Video file</p>
			</div>
			<div class="input-item">
				<input type="text" name="title" placeholder="This is title for video" title="Title text">
			</div>
			<div class="input-item">
				<input type="file" accept="image/png" name="preview" placeholder="Preview pictrure" title="Target pictrure">
				<p class="placeholder">Preview picture file</p>
			</div>
			<div class="input-item">
				<textarea name="description" placeholder="Description" title="Descript your video (compatible html tags)"></textarea>
			</div>
			<div class="input-item">
				<button type="submit">Submit</button>
			</div>
		</form>
		Go To <a href="../profile.php">Profile</a>
		Go To <a href="../analitics/">Analitics</a>
		-->
	</div>
</body>
</html>
