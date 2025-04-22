<?php 
	if($_COOKIE == []){
		header("Location: /login");
	}
 ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage'])) {
    $username = $_COOKIE['name']; 
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/accounts/Images/';
    $uploadFile = $uploadDir . $username . '.jpg'; 


    if ($_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['profileImage']['tmp_name'];
        $fileType = mime_content_type($tmpName);

        if (in_array($fileType, ['image/png', 'image/jpeg', 'image/jpg'])) {
            if (move_uploaded_file($tmpName, $uploadFile)) {
                echo "<script>alert('Profile image updated successfully!');</script>";
            } else {
                echo "<script>alert('Failed to upload the image.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Please upload a PNG or JPG image.');</script>";
        }
    } else {
        echo "<script>alert('Error uploading the file.');</script>";
    }
}

if (isset($_POST['logout'])) {
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', time() - 3600, '/');
    }
    header("Location: /login");
    exit();
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
								event.preventDefault(); 
								index += event.deltaY > 0 ? 1 : -1;
								index = Math.max(0, Math.min(index, totalBubbles - 3));
								slider.style.transform = `translateX(${-index * bubbleWidth}px)`;
							});
						</script>


					</div>

					<div class="ChannelBanner">

							<?php
							$imagePath = '/accounts/Banners/' . $usr->name . '.jpg';
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
									<img class="imageMask" width="100%" src="<?php echo $imagePath; ?>" alt="AccountBanner">
								<?php endif; ?>

								<div class="ProfileInformation">
									<?php
									$imagePath = '/accounts/Images/' . $usr->name . '.jpg';
									$hasImage = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath);
									?>
									<div class="profileInfoLow">
											<div class="profileBorder">
												<img class="profileImage" width="96" height="96" src="<?php echo $hasImage ? $imagePath : '/ico/profiledefault.png'; ?>" alt="Profile Image">
											</div>
											<div class="profileName"><?=$usr->name?></div>
									</div>
								</div>
							</div>
					</div>
					
					<div class="videos">
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
		</body>
	</html>


				<?php else: ?>

				<?php
				define('WAY', 'accounts/');

				$name = $_COOKIE['name'];

				$usr = json_decode(file_get_contents(WAY . $name . ".conf"));

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
								event.preventDefault(); 
								index += event.deltaY > 0 ? 1 : -1;
								index = Math.max(0, Math.min(index, totalBubbles - 3));
								slider.style.transform = `translateX(${-index * bubbleWidth}px)`;
							});
						</script>


					</div>

					<div class="ChannelBanner">

							<?php
							$imagePath = '/accounts/Banners/' . $usr->name . '.jpg';
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
									<img class="imageMask" width="100%" src="<?php echo $imagePath; ?>" alt="AccountBanner">
								<?php endif; ?>

								<div class="ProfileInformation">
									<?php
									$imagePath = '/accounts/Images/' . $usr->name . '.jpg';
									$hasImage = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath);
									?>
									<div class="profileInfoLow">
											<div class="profileBorder">
												<img class="profileImage" width="96" height="96" src="<?php echo $hasImage ? $imagePath : '/ico/profiledefault.png'; ?>" alt="Profile Image">
											</div>
											<div class="profileName"><?=$usr->name?></div>
									</div>
								</div>
								<div class="customize">
									
									<div class="goToStudio">
										<a href="/studio/index.php" class="goToStudioButton">Studio</a>
									</div>

									<div class="IconImport">
										<form action="/profile.php" method="POST" enctype="multipart/form-data">
											<input type="file" id="iconInput" name="profileImage" accept="image/png, image/jpg, image/jpeg" style="display: none;" onchange="this.form.submit();">
											<button class="IconImportButton" type="button" onclick="document.getElementById('iconInput').click();">
												<img class="iconico" src="/ico/profiledefault.png" width="20px" height="20px">
											</button>
										</form>
									</div>

									<div class="logout">
										<form action="/profile.php" method="POST">
											<button class="logoutButton" type="submit" name="logout">Logout</button>
										</form>
									</div>
								</div>

							</div>
					</div>
					
					<div class="videos">
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
		</body>
	</html>

				<?php endif ?>
			</div>
		</body>
	</html>