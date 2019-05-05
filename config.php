<?php

$host 		= "localhost";
$dbusername	= "root";
$dbpassword	= "";
$dbname		= "TA_anotasi";

$link = mysqli_connect($host, $dbusername, $dbpassword, $dbname)
or die("Salah server, nama pengguna, atau passwordnya!"); 
?>