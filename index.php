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
	<link rel="stylesheet" type="text/css" href="/style/legacy.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h1 style="margin: 0px;">FreeTube</h1>
			<p style="margin-left: 30px; font-size: 20px; margin-top: 10px;">FreeTube - free, open source and the best analog of YT <a style="position: absolute; right: 5px;" href="http://github.com/NThacker5246/FreeTube">Source Code</a> </p>
		</div>
		<div class="main-videos">
			<?php
			for ($i=1; $i < $data->count; $i++) { 
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
</body>
</html>