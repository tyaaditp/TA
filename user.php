<?php
 require('./config.php');

$sql = mysqli_query($link, "SELECT id, nama FROM user where parent_id = '$parent_id' and role = 'Expert' ");

while ($row = mysqli_fetch_row($sql)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}