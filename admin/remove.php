<?php

$fld = scandir("../db");

//removing table of videos

foreach ($fld as $file) {
	if ($file == ".." || $file == "." || $file == "db.php" || $file == "table.json") continue; 
	unlink("../db/$file");
}

//set table to inital count

$table = fopen("../db/table.json", "w");
$tb = fwrite($table, '{"count":1}');
$td = fclose($table);

//removing comments

$fld = scandir("../comments");

foreach ($fld as $file) {
	if ($file == ".." || $file == ".") continue; 
	unlink("../comments/$file");
}

//removing config

$fld = scandir("../config");

foreach ($fld as $file) {
	if ($file == ".." || $file == ".") continue; 
	unlink("../config/$file");
}

//removing videos

$fld = scandir("../videos");

foreach ($fld as $file) {
	if ($file == ".." || $file == ".") continue; 
	unlink("../videos/$file");
}

//removing users

$fld = scandir("../accounts");

foreach ($fld as $file) {
	if ($file == ".." || $file == ".") continue; 
	unlink("../accounts/$file");
}

//removing previews

$fld = scandir("../preview");

foreach ($fld as $file) {
	if ($file == ".." || $file == ".") continue; 
	unlink("../preview/$file");
}

//reset done! going to oobe

header("Location: /admin/setup");
