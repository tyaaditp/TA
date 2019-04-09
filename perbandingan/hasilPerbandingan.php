<?php
session_start();
require('../config.php');

$user_id = $_SESSION['id'];
$query = "SELECT image_original.id as 'original_id', image_original.user_id as 'original_user_id', image_original.image as 'original_image', image_anotated.id as 'anotated_id', image_anotated.user_id as 'anotated_user_id', image_anotated.image_id as 'anotated_reference', image_anotated.image as 'anotated_image' from image_original INNER JOIN image_anotated ON image_original.id=image_anotated.image_id AND image_anotated.user_id = " . $user_id;
$sql2 = mysqli_query($link, $query);

?>

<table border=1>
<thead>
    <tr>
        <td> user id </td>
        <td> image original </td>
        <td> image anotated </td>
        <td> image anotated reference </td>
        <td> link </td>
    </tr>
</thead>
<tbody>
<?php
if(mysqli_num_rows($sql2)>0) {
    while ($row2 = mysqli_fetch_assoc($sql2)) {

        /*
        if(substr($row2[0], -3) != "jpg")
            $row2[0] .= ".jpg"; 
            */
            //var_dump($row2);
            echo '<tr>';
            echo '<td>' . $row2['anotated_user_id'] . '</td>'; 
            echo '<td> <img widht=40 src="'  . $row2['original_image'] . '" ></td>'; 
            echo '<td>' . $row2['anotated_image'] . '</td>'; 
            $querySelectFirstAnotated = 'select * from image_anotated where image_id='.$row2['anotated_reference'].' and user_id='.$row2['original_user_id'].' limit 1';
            //echo $querySelectFirstAnotated;
            $sql3 = mysqli_query($link, $querySelectFirstAnotated);
            if(mysqli_num_rows($sql3) == 1) {
                $rowOfFirstAnotated = mysqli_fetch_array($sql3);
                echo '<td>' . $rowOfFirstAnotated['image'] . '</td>';
                $image1 = substr($rowOfFirstAnotated['image'], 3);
                $image2 = substr($row2['anotated_image'], 3);
                echo '<td> <a href="/TA/perbandingan/perbandinganPixel.php?image1='.$image1.'&image2='.$image2.'"> Link Perbandingan </a></td>'; 
            } 
            
            echo '</tr>';

           

    }

}
?>

</tbody>
</table>
