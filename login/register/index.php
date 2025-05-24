<!DOCTYPE html>
	<html>
		<head>
			<title>Login - FreeTube</title>
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="/style/styleLogin.css">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="/style/styleChannel.css" media="(min-width: 768px)">
			<link rel="stylesheet" type="text/css" href="/style/mobile/styleLogin.css" media="(max-width: 767px)">
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
						<img class="profileIcon" width="25" height="25" src="/ico/profileicon.png"/>
					</a>

					<script>
						const slider = document.getElementById("themeSelecter");
						let index = 0;
						const totalBubbles = document.querySelectorAll(".bubble").length;
						const bubbleWidth = 26;

						slider.addEventListener("wheel", (event) => {
							event.preventDefault(); 
							index += event.deltaY > 0 ? 1 : -1;
							index = Math.max(0, Math.min(index, totalBubbles - 3));
								slider.style.transform = `translateX(${-index * bubbleWidth}px)`;
						});
					</script>


				</div>
				<div class="loginPage">
					<div class="loginBubble">
						<div class="loginText">Register</div>
						<form action="reg.php" method="POST" enctype="multipart/form-data">
							<input type="text" name="name" placeholder="Nickname">
							<br>
							<input type="text" name="email" placeholder="Email">
							<br>
							<input type="text" name="number" placeholder="+7(800)555-35-35">
							<br>
							<input type="password" name="pwd" placeholder="Your password">
							<br>
							<button type="submit" class="submitButton">Register</button>
						</form>
						<span class="NoAcc">Already have an account?</span>
						<a href="/login">Login</a>
					</div>
				</div>
			</div>
		</body>
	</html>


<!--
<form action="reg.php" method="POST" enctype="multipart/form-data">
	<input type="text" name="name" placeholder="Nickname">
	<input type="text" name="email" placeholder="Email">
	<input type="text" name="number" placeholder="+7(800)555-35-35">
	<br>
	<input type="password" name="pwd" placeholder="Your password">
	<br>
	<button type="submit">Register</button>
</form>

Already have an account? <a href="..">Log on!</a>
-->