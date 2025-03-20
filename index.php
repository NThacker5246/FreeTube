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
			<div class="headerBubble">
                <span class="bubbleText">FreeTube</span>
                <span class="bubbleTextsh">FreeTube</span>
            </div>
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
	</div>
</body>
</html>