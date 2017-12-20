<?php

define('DB_HOST','50.63.226.198');
define('DB_USER','ucsdcarpool');
define('DB_PASSWORD','Qy7QbqjSr8@w');
define('DB_SCHEMA','ucsdcarpool');
define('DB_TBL_PREFIX','');

date_default_timezone_set("Etc/GMT-8");

if (!$GLOBALS['DB'] = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD)){
    die ('Error: Unable to connect to database server.');
}

if (!mysql_select_db(DB_SCHEMA,$GLOBALS['DB'])){
    mysql_close($GLOBALS['DB']);
    die ('Error: Unable to select database schema.');
}

?>
