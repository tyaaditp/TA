<?php
session_start();
require('../config.php');
$image_id = $_POST['image_id'];
$analisis = $_POST['isianalisis'];

foreach ($_FILES["images"]["error"] as $key => $error) {
  if ($error == UPLOAD_ERR_OK) {
    $name = $_FILES["images"]["name"][$key];
    $path = "/TA/uploads/" . "ano-" . $_SESSION['username'] . '-' . rand(0,1000); 
    $destination = $_SERVER['DOCUMENT_ROOT'] . "/TA/uploads/" . basename($path);
    $userId = $_SESSION['id'];
    move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $destination);
    //mysql
    $sql = "INSERT INTO image_anotated(user_id, image_id, image,analisis) VALUES (
        '$userId','$image_id','$path','$analisis')";

    $execute  = mysqli_query($link, $sql);

  }
}
 
echo "<h2>Successfully Uploaded Images</h2>";