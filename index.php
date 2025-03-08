<?php
	$fdata = file_get_contents("./db/table.json");
	$data = json_decode($fdata);
?>

<!DOCTYPE html>
<html>
<head>
	<title>FreeTube - free, open source and the best analog of YT</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/style/legacy.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h1 style="margin: 0px;">FreeTube</h1>
			<p style="margin-left: 30px; font-size: 20px; margin-top: 10px;">FreeTube - free, open source and the best analog of YT <a style="margin-left: 70px;  margin-top: 0px;" href="http://github.com/NThacker5246/FreeTube">Source</a> </p>
		</div>
		<div class="main-videos">
			<?php
			for ($i=1; $i < $data->count; $i++) { 
				echo "
				<a href=\"/watch.php?video=$i\">
					<div class=\"card\">
						<img src=\"preview.png\">
						<p>$i video</p>
					</div>
				</a>";
			}
			?>
		</div>
	</div>
</body>
</html>