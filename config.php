<!-- XAMPP -->

<?php

$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '1111';
$dbname = 'rd5';
$port = 3306;
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
mysqli_query($link, "set names utf-8");

?> 