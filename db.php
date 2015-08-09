<?php

define('HOST', 'localhost');
define('DB', 'gallery_db');
define('USER', 'root');
define('PSWD', '');

$dbh = mysql_connect(HOST, USER, PSWD) or die("Не могу соединиться с MySQL.");
mysql_select_db(DB) or die("Не могу подключиться к базе.");
?>