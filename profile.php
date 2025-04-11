<?php 
	if($_COOKIE == []){
		header("Location: /login");
	}
 ?>

<?php if (!empty($_GET['chan'])): ?>

<?php
define('WAY', 'accounts/');

$usr = json_decode(file_get_contents(WAY . $_GET['chan'] . ".conf"));

?>

<!DOCTYPE html>
	<html>
		<head>
			<title><?=$usr->name?> - FreeTube</title>
			<meta charset="utf-8">
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="/style/styleChannel.css">
			<link rel="icon" href="/favicon.ico" type="image/x-icon">
		</head>
		<body>

			<div>
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

					<div class="ChannelBanner">

							<?php
							$imagePath = '/accounts/Banners/' . $usr->name . 'banner.png';
							$hasImage = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath);

							
							function generateLessSaturatedColor() {
								$r = mt_rand(200, 255); 
								$g = mt_rand(200, 255); 
								$b = mt_rand(200, 255); 
								return sprintf('#%02X%02X%02X', $r, $g, $b);
							}

							$bgColor = generateLessSaturatedColor();
							?>

							<div class="ChannelBanner" style="background-color: <?php echo !$hasImage ? $bgColor : 'transparent'; ?>;">
								<?php if ($hasImage): ?>
									<img src="<?php echo $imagePath; ?>" alt="AccountBanner">
								<?php endif; ?>

								<div class="ProfileInformation">
									<?php
									$imagePath = '/accounts/Images/' . $usr->name . '.png';
									$hasImage = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath);
									?>
									<div class="profileInfoLow">
										<div class="profileBorder">
											<img class="profileImage" width="96" height="96" src="<?php echo $hasImage ? $imagePath : '/ico/profiledefault.png'; ?>" alt="Profile Image">
										</div>
										<span class="profileName"><?=$usr->name?></span>
									</div>
								</div>

							</div>
					</div>

					<?php
						for ($i=0; $i < count($usr->videoCreated); $i++) { 
						$conf = file_get_contents("./config/" . $usr->videoCreated[$i] . ".conf");
						$kw = explode("!HCRGMKARS%!", $conf);
						$name = explode("ALGSTD!24", $kw[0])[1];
						echo "
						<a class=\"card\" href=\"/watch.php?video=" . $usr->videoCreated[$i] . "\">
							<div>
								<img class=\"cardvid\" src=\"/preview/". $usr->videoCreated[$i] .".png\" width=\"300px\" height=\"168.75px\">
								<div class=\"cardtext\">$name</div>
							</div>
						</a>";
						}
					?>
				</div>
			</div>


				<?php else: ?>

				<?php
				define('WAY', 'accounts/');

				$name = $_COOKIE['name'];

				$usr = json_decode(file_get_contents(WAY . $name . ".conf"));

				?>

				<div>
					<h1>Hello, <?=$usr->name?>!</h1>
					<p>Password: <?=$usr->password?></p>
					<p>Phone: <?=$usr->phone?></p>
					<p>Mail: <?=$usr->email?></p>
					<a href="/studio/index.php">Go to creator studio</a>
					<a href="logoff.php"></a>
				</div>

				<?php endif ?>
			</div>
		</body>
	</html>