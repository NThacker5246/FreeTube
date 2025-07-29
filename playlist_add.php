<?php


$pl_name = $_GET["name"];
$video_ids = $_GET["data"];
$mode = $_GET["mode"];

switch ($mode) {
	case 'write':
		$file = fopen("playlists/$video_ids", "w");
		$fw = fwrite($file, $video_ids);
		$fc = fclose($file);
		break;

	case 'read':
		echo file_get_contents("playlists/$video_ids");
		break;

	case 'write_add':
		$fd = file_get_contents("playlists/$video_ids");
		$fd .= "," . $video_ids;
		$file = fopen("playlists/$video_ids", "w");
		$fw = fwrite($file, $fd);
		$fc = fclose($file);
		break;
	
	default:
		# code...
		break;
}
