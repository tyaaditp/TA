<?php
header("Access-Control-Allow-Origin: *");
session_start();
require('./config.php');
if (isset($_GET['parent_id'])){
    $parent_id = $_GET['parent_id'];
}else{
    $parent_id = $_SESSION['parent_id'];
}



$sql = mysqli_query($link, "SELECT id, nama FROM user where parent_id = '$parent_id'");

while ($row = mysqli_fetch_row($sql)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}