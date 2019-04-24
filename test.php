<?php
require('./config.php');
?>


<form action="" method="post">
<select name="coba">

<?php
$sql = mysqli_query($link, "SELECT id, nama FROM user");
while ($row = mysqli_fetch_row($sql)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

?>
</select>    
<input type="submit" name="action" value="pilih" />
<div id="url_here" > </div>
<?php
if(isset($_POST["action"]) && ($_POST["action"] == "pilih")) {
    $sql2 = mysqli_query($link, "SELECT image FROM image_original WHERE user_id='".$_POST["coba"]."'");
    if(mysqli_num_rows($sql2)>0) {
        while ($row2 = mysqli_fetch_row($sql2)) {
            /*
            if(substr($row2[0], -3) != "jpg")
                $row2[0] .= ".jpg"; 
                */
                $link = "clicked('$row2[0]')";
                echo '<img onclick="'.$link.'" id="img" src="'.$row2[0].'" alt="gambar origninal" width="200"/><br/>';

        }

    }
    

}


?>