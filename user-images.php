<?php
$host 		= "localhost";
$username	= "root";
$password	= "";
$dbname		= "TA_anotasi";

$link = mysqli_connect($host, $username, $password, $dbname)
or die("Salah server, nama pengguna, atau passwordnya!"); 
$user_id = $_SESSION 

$sql2 = mysqli_query($link, "SELECT image FROM image_original WHERE user_id='".$user_id."'");
if(mysqli_num_rows($sql2)>0) {
    while ($row2 = mysqli_fetch_row($sql2)) {
        /*
        if(substr($row2[0], -3) != "jpg")
            $row2[0] .= ".jpg"; 
            */
            $style =     'display: inline-block; max-width: 98%; height: auto; width: 30%; margin: 1%;';
            $click = "selectImage('$row2[0]')";
            echo '<img  onclick="'.$click.'" style="'. $style . '" id="img" src="'.$row2[0].'" alt="gambar origninal" width="200"/>';

    }

}