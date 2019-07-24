<?php
header("Access-Control-Allow-Origin: *");
session_start();
require('./config.php');
$user_id = $_POST['user_id'];
$parent_id = $_POST['parent_id'];
$query = "SELECT image_original.id as 'original_id', image_original.user_id as 'original_user_id', image_original.image as 'original_image', image_anotated.id as 'anotated_id', image_anotated.user_id as 'anotated_user_id', image_anotated.image_id as 'anotated_reference', image_anotated.image as 'anotated_image', image_anotated.analisis as 'anotated_analisis'  from image_original INNER JOIN image_anotated ON image_original.id=image_anotated.image_id AND image_anotated.user_id = " . $user_id;

$sql2 = mysqli_query($link, $query);
if(mysqli_num_rows($sql2)>0) {
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $querySelectFirstAnotated = 'select * from image_anotated where image_id='.$row2['anotated_reference'].' and user_id='.$row2['original_user_id'].' limit 1';
            //echo $querySelectFirstAnotated;
            $sql3 = mysqli_query($link, $querySelectFirstAnotated);
            if(mysqli_num_rows($sql3) == 1) {
                $rowOfFirstAnotated = mysqli_fetch_array($sql3);
                $image2 = $rowOfFirstAnotated['image'];
                $analisis2 = $rowOfFirstAnotated['analisis'];
                $image1 = $row2['anotated_image'];
                $analisis1 = $row2['anotated_analisis'];
                $style =     'display: inline-block; max-width: 98%; height: auto; width: 30%; margin: 1%;';
                $htmlimage = '<img style="'. $style . '" id="img" src="/'.$row2['anotated_image'].'" alt="gambar origninal" width="200"/>' ;

                echo '<a href="/python?parent_id='.$parent_id.'&path1='.$row2['original_image'].'&path2='.$image1.'&path3='.$image2. '&analisis1='.$analisis1. '&analisis2='.$analisis2.'">' . $htmlimage . '</a>' ;

            }

            
    }

}