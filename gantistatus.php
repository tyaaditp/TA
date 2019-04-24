<?php
require('./config.php');
session_start();
$id = $_POST['id'] ;
if ($_POST['akses']==1) {
    $status = 0;
} else {
    $status = 1;
}

$sql = "UPDATE user SET akses ='$status' WHERE id='$id'";
$execute  = mysqli_query($link, $sql);
if($execute) {
    header('Location: /super.php');        
    }
else {
    alert('Your username or password wrong!');	
    //header('Location: /login.php');
}

?>