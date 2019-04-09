<?php
session_start();
$host 		= "localhost";
$username	= "root";
$password	= "";
$dbname		= "TA_anotasi";
$parent_id         = $_SESSION['parent_id'];

$link = mysqli_connect($host, $username, $password, $dbname)
or die("Salah server, nama pengguna, atau passwordnya!"); 

$sql = mysqli_query($link, "SELECT id, nama FROM user where parent_id = '$parent_id' and role = 'Expert' ");

while ($row = mysqli_fetch_row($sql)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}