<!DOCTYPE html>
<html>
<head>
	<title>FreeTube Setup</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="setup.css">
</head>
<body>
	<div class="main">
		<form action="setup.php" method="GET">
			<div class="card">
				<h1>Is it right region?</h1>
				<select name="region">
					<option value="ru">Russia</option>
				</select>
			</div>
			<div class="card hidden">
				<h1>Is it your right language?</h1>
				<select name="lang">
					<option value="en">English</option>
					<option value="ru">Russian</option>
				</select>
			</div>
			<div class="card hidden">
				<h1>Create a administator account</h1>
				<input type="text" name="name" id="name">
			</div>
			<div class="card hidden">
				<h1>Create a super memoriable password</h1>
				<input type="password" name="pass" id="pass">
			</div>
			<div class="card hidden">
				<h1>Set up some tweaks</h1>
				None
			</div>
			<button class="go-sub hidden" id="final" type="submit">Finallize setup</button>
		</form>
		<button class="go" id="next">Next</button>		
	</div>
	<script type="text/javascript" src="nexter.js"></script>
</body>
</html>