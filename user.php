<?php
session_start();
require('./config.php');
$parent_id = $_SESSION['parent_id'];

$sql = mysqli_query($link, "SELECT id, nama FROM user where parent_id = '$parent_id' and role = 'Expert' ");

while ($row = mysqli_fetch_row($sql)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}