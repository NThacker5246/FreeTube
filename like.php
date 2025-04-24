<?php



	$data = $_GET['d'];
	$v = $_GET['v'];
	
	switch ($data) {
		case 'like':
			define('WAY', 'accounts/');
			require_once 'login/db/account.php';
			$td = $_COOKIE['name'];
			$result = file_get_contents("config/$v.conf");
			$dt = explode("!HCRGMKARS%!", $result);
			$sol = "";
			for ($i=0; $i < count($dt); $i++) { 
				$msg = $dt[$i];
				$smg = explode("ALGSTD!24", $msg);
				if ($smg[0] == "likes") {
					$newMSG = "";
					//var_dump(getUserParam($td, "videoLiked", $v));
					if (!getUserParam($td, "videoLiked", $v)) {
						$newMSG = $smg[0] . "ALGSTD!24" . strval(intval($smg[1]) + 1);
						echo strval(intval($smg[1]) + 1);
						$sol .= $newMSG;
						$sol .= "!HCRGMKARS%!";
						//repUserParam($td, "videoLiked", 0, $v);
						writeUserParam($td, $v, "videoLiked");
					} else if (getUserParam($td, "videoLiked", $v)) {
						$newMSG = $smg[0] . "ALGSTD!24" . strval(intval($smg[1]) - 1);
						echo strval(intval($smg[1]) - 1);
						$sol .= $newMSG;
						$sol .= "!HCRGMKARS%!";
						repUserParam($td, "videoLiked", $v, 0);
					}
					
				} else {
					$sol .= $msg;
					$sol .= "!HCRGMKARS%!";
				}
			}
			$sol = trim($sol, "!HCRGMKARS%!");

			$cn = fopen("config/$v.conf", "w");
			$ns = fwrite($cn, $sol);
			$cs = fclose($cn);
			break;
		
		case 'dislike':
			define('WAY', 'accounts/');
			require_once 'login/db/account.php';
			$td = $_COOKIE['name'];
			$result = file_get_contents("config/$v.conf");
			$dt = explode("!HCRGMKARS%!", $result);
			$sol = "";
			for ($i=0; $i < count($dt); $i++) { 
				$msg = $dt[$i];
				$smg = explode("ALGSTD!24", $msg);
				if ($smg[0] == "dislikes") {

					if (!getUserParam($td, "videoDisliked", $v)) {
						$newMSG = $smg[0] . "ALGSTD!24" . strval(intval($smg[1]) + 1);
						echo strval(intval($smg[1]) + 1);
						$sol .= $newMSG;
						$sol .= "!HCRGMKARS%!";
						//repUserParam($td, "videoLiked", 0, $v);

						writeUserParam($td, $v, "videoLiked");
					} else if (getUserParam($td, "videoDisliked", $v)) {
						$newMSG = $smg[0] . "ALGSTD!24" . strval(intval($smg[1]) - 1);
						echo strval(intval($smg[1]) - 1);
						$sol .= $newMSG;
						$sol .= "!HCRGMKARS%!";
						repUserParam($td, "videoLiked", $v, 0);
					}
				} else {
					$sol .= $msg;
					$sol .= "!HCRGMKARS%!";
				}
			}
			$sol = trim($sol, "!HCRGMKARS%!");


			$cn = fopen("config/$v.conf", "w");
			$ns = fwrite($cn, $sol);
			$cs = fclose($cn);
			break;
		
		case 'gatherLikes':
			$result = file_get_contents("config/$v.conf");
			$dt = explode("!HCRGMKARS%!", $result);
			for ($i=0; $i < count($dt); $i++) { 
				$msg = $dt[$i];
				$smg = explode("ALGSTD!24", $msg);
				if ($smg[0] == "likes") {
					echo strval(intval($smg[1]));
				}
			}
			break;

		case 'gatherDislikes':
			$result = file_get_contents("config/$v.conf");
			$dt = explode("!HCRGMKARS%!", $result);
			for ($i=0; $i < count($dt); $i++) { 
				$msg = $dt[$i];
				$smg = explode("ALGSTD!24", $msg);
				if ($smg[0] == "dislikes") {
					echo strval(intval($smg[1]));
				}
			}
			break;

		case "views":
			$result = file_get_contents("config/$v.conf");
			$dt = explode("!HCRGMKARS%!", $result);
			$sol = "";
			for ($i=0; $i < count($dt); $i++) { 
				$msg = $dt[$i];
				$smg = explode("ALGSTD!24", $msg);
				if ($smg[0] == "views") {
					$newMSG = $smg[0] . "ALGSTD!24" . strval(intval($smg[1]) + 1);
					echo strval(intval($smg[1]) + 1);
					$sol .= $newMSG;
					$sol .= "!HCRGMKARS%!";
				} else {
					$sol .= $msg;
					$sol .= "!HCRGMKARS%!";
				}
			}
			$sol = trim($sol, "!HCRGMKARS%!");

			$cn = fopen("config/$v.conf", "w");
			$ns = fwrite($cn, $sol);
			$cs = fclose($cn);
			break;
	}
?>