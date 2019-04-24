<?php
session_start();
require('../config.php');
foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["images"]["name"][$key];
    $path = "/uploads/" . "ori-" . $_SESSION['username'] . '-' . rand(0,1000); 
    $destination = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . basename($path);
    $userId = $_SESSION['id'];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $destination);
    //mysql
    $sql = "INSERT INTO image_original(user_id, image) VALUES (
        '$userId','$path')";

    $execute  = mysqli_query($link, $sql);
    if ($execute) {
      echo mysqli_insert_id($link);
    }

  }
}