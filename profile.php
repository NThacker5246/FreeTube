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

<div>
	<H1>Channel: <?=$usr->name?></H1>
	<?php
		for ($i=0; $i < count($usr->videoCreated); $i++) { 
			$conf = file_get_contents("./config/" . $usr->videoCreated[$i] . ".conf");
			$kw = explode("!HCRGMKARS%!", $conf);
			$name = explode("ALGSTD!24", $kw[0])[1];
			echo "
			<a href=\"/watch.php?video=" . $usr->videoCreated[$i] . "\">
				<div class=\"card\">
					<img src=\"/preview/". $usr->videoCreated[$i] .".png\" width=\"300px\" height=\"168.75px\">
					<p>$name</p>
				</div>
			</a>";
		}
	?>
</div>


<?php else: ?>

<?php
define('WAY', 'accounts/');

$pd = $_COOKIE['Password'];

$usr = json_decode(file_get_contents(WAY . $pd . ".conf"));

?>

<div>
	<h1>Hello, <?=$usr->name?>!</h1>
	<p>Password: <?=$pd?></p>
	<p>Phone: <?=$usr->phone?></p>
	<p>Mail: <?=$usr->email?></p>
	<a href="/studio/index.php">Go to creator studio</a>
	<a href="logoff.php"></a>
</div>

<?php endif ?>