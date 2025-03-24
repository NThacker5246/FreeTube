<?php
	$comment = $_GET['comment'];
	$v = $_GET['v'];
	$name = $_COOKIE['name'];
	$md = $_GET['m'];
	
	switch ($md) {
		case 'write':
			$save_cm = "<div>$name> $comment</div>";
			if (file_exists("./comments/$v.txt")) {
				$save_cm = file_get_contents("./comments/$v.txt") . $save_cm;
			}
			$file = fopen("./comments/$v.txt", "w");
			$fw = fwrite($file, $save_cm);
			$fc = fclose($file);
			echo "$save_cm";
			break;

		case 'read':
			if(file_exists("./comments/$v.txt")){			
				$save_cm = file_get_contents("./comments/$v.txt");
				echo "$save_cm";
			}
			break;
		
		default:
			# code...
			break;
	}

	

?>