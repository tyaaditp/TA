<?php
header("Access-Control-Allow-Origin: *");
session_start();
require('./config.php');
$user_id = $_POST['user_id'];
$parent_id = $_POST['parent_id'];
$image_ori = $_POST['image_ori'];
$image_reference = $_POST['image_ref'];
//$image_anotated = $_POST['image_ano'];
$query = "select * FROM image_anotated WHERE user_id = " . $user_id . " and image_id = (select id from image_original where image='/uploads/".$image_ori.  "') " ;

$sql2 = mysqli_query($link, $query);
while ($row2 = mysqli_fetch_assoc($sql2)) {
    $querySelectFirstAnotated = "select * from image_anotated where image='/uploads/".$image_reference."' limit 1";
        //echo $querySelectFirstAnotated;
        $sql3 = mysqli_query($link, $querySelectFirstAnotated);
        
        if(mysqli_num_rows($sql3) == 1) {
            //
            $rowOfFirstAnotated = mysqli_fetch_array($sql3);
            $image1 = $rowOfFirstAnotated['image'];
            $analisis1 = $rowOfFirstAnotated['analisis'];
            
            //
            $image2 = $row2['image'];
            $analisis2 = $row2['analisis'];
            $style =     'display: inline-block; max-width: 98%; height: auto; width: 30%; margin: 1%;';
            $htmlimage = '<img style="'. $style . '" id="img" src="'.$row2['image'].'" alt="gambar origninal" width="200"/>' ;

            echo '<a href="/python?parent_id='.$parent_id.'&path1=/uploads/'.$image_ori.'&path2='.$image1.'&path3='.$image2. '&analisis1='.$analisis1. '&analisis2='.$analisis2.'">' . $htmlimage . '</a>' ;

        }


}