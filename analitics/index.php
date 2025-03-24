<!DOCTYPE html>
<html>
<head>
	<title>FreeTube Analitics</title>
</head>
<?php if(!empty($_GET["num"])):?>

<body>
	<?php 
		//$user = json_decode(file_get_contents("../accounts/" . $_COOKIE['name'] . ".conf"));
		$video = file_get_contents("../config/" . $_GET["num"] . ".conf");
		$params = explode("!HCRGMKARS%!", $video);
	?>

	<h1><?=$_COOKIE['name']?>, welcome to FreeTube analitics!</h1>
	<h2>There, you can see your videos tranding:</h2>
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
</body>
</html>

<?php else: ?>

<body>

	<?php 
		$user = json_decode(file_get_contents("../accounts/" . $_COOKIE['name'] . ".conf"));
	?>

	<h1><?=$_COOKIE['name']?>, welcome to FreeTube analitics!</h1>
	<h2>There, you can see your videos tranding:</h2>
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

</body>
</html>
<?php endif?>