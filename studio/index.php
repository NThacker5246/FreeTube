<!DOCTYPE html>
<html lang="ru">
<head>
	<title>FreeTube creator studio</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style/legacyStudio.css">
</head>
<body>
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
			<input type="text" name="description" placeholder="Description" title="Descript your video (compatible html tags)">
		</div>
		<div class="input-item">
			<button type="submit">Submit</button>
		</div>
	</form>

</body>
</html>
