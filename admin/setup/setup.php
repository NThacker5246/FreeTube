<?php

var_dump($_GET);

define('WAY', '../../accounts/');
require_once '../../login/db/account.php';

addUser($_GET["pass"], $_GET["name"], "", "");
setcookie("name", $_GET["name"], time() + 0x7FFFFFFF, "/");

$_SESSION['name'] = $_GET["name"];
header("Location: /admin/index.php");
?>