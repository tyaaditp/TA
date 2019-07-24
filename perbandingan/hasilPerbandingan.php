<?php
session_start();
require('../config.php');

$user_id = $_SESSION['id'];
$query = "SELECT image_original.id as 'original_id', image_original.user_id as 'original_user_id', image_original.image as 'original_image', image_anotated.id as 'anotated_id', image_anotated.user_id as 'anotated_user_id', image_anotated.image_id as 'anotated_reference', image_anotated.image as 'anotated_image', image_anotated.analisis as 'anotated_analisis'  from image_original INNER JOIN image_anotated ON image_original.id=image_anotated.image_id AND image_anotated.user_id = " . $user_id;
$sql2 = mysqli_query($link, $query);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" type="image/png" href="/logooptan.png"/>
    <meta charset="UTF-8">
    <title>Annotation Page|OPTAN</title>
    <meta name="author" content="TA-L">
    <meta name="description" content="Optan is a standalone image annotator application">

    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="../optancss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- custom CSS -->
    <style>
    table{
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }
    thead{
        font-family: sans-serif;
        background-color: #efb523;
        text-align: center;
        font-weight: bold;
        color: white;
    }
    tbody tr:nth-child(even){
        background-color: #f2f2f2;
    }
    td{
        text-align: center;
        
    }
    .navbar{
        /* margin:0 !important; */
        margin-bottom: 50px;
	    /* padding: 0px !important; */
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        padding-right: 10px;
        padding-left: 10px;
    }
    </style>

</head>

<body>

<!-- navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <img src="minilogo.png" alt="minilogo optan" class="mr-3" href="index.php" style="width:5em;">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">Back to Annotation Page <span class="sr-only">(current)</span></a> -->
        <?php
            if(($_SESSION['role']) == 'Expert' ) {
                echo '<a href="/trialz.php" style="color: beige;">Back to annotation page</a> ';
            }
            else {
                echo '<a href="/trialzUser.php" style="color: beige;">Back to annotation page</a>';
            }
        ?>
      </li>
    </ul>
    <ul class="navbar-nav mr-auto">
      <h3 style="text-align: center; font-family:sans-serif; color: #efb523;">Annotation Similarity</h3>
    </ul>
    <form action="" class="form-inline my-2 my-lg-0">
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" style="color:beige;"><?php echo $_SESSION['username'] ?> as <?php echo $_SESSION['role'] ?></a>
        <!-- <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="" style="color:beige;"><?php echo $_SESSION['role'] ?></a> -->
        <!-- <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="index.php" style="color:beige;">Home</a> -->
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="/logout.php" style="color:beige;"><button type="button" class="btn btn-outline-secondary btn-sm">Logout</button></a>
    </form>
  </div>
</nav>

<!-- end of navbar -->

<!-- <h2 style="text-align: center; font-family:sans-serif;">Annotation Similarity</h2> -->

<!-- <?php
    if(($_SESSION['role']) == 'Expert' ) {
        echo '<a href="/trialz.php"><p style="text-align: center;"><button style="background-color:#050300; color:#e8c033; font-family:sans-serif;">Back to annotation page</button></p></a> ';
    }
    else {
        echo '<a href="/trialzUser.php"><p style="text-align: center;"><button style="background-color:#050300; color:#e8c033; font-family:sans-serif;">Back to annotation page</button></p></a>';
    }
?> -->
<table border=1> 
<thead>
    <tr>
        <!-- <td> User id </td> -->
        <td> Image original </td>
        <td> Image anotated </td>
        <td> Image anotated reference </td>
        <td> Result </td>
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
            // echo '<td>' . $row2['anotated_user_id'] . '</td>'; 
            echo '<td> <img width=400 src="'  . $row2['original_image'] . '" ></td>';
            echo '<td> <img width=400 src="'  .$row2['anotated_image'] . '" ></td>'; 
            
            $querySelectFirstAnotated = 'select * from image_anotated where image_id='.$row2['anotated_reference'].' and user_id='.$row2['original_user_id'].' limit 1';
            //echo $querySelectFirstAnotated;
            $sql3 = mysqli_query($link, $querySelectFirstAnotated);
            if(mysqli_num_rows($sql3) == 1) {
                $rowOfFirstAnotated = mysqli_fetch_array($sql3);
                echo '<td> <img width=400 src="'  . $rowOfFirstAnotated['image'] . '" ></td>';
                $image1 = $rowOfFirstAnotated['image'];
                $analisis1 = $rowOfFirstAnotated['analisis'];
                $image2 = $row2['anotated_image'];
                $analisis2 = $row2['anotated_analisis'];
                // echo '<td> <a href="/perbandingan/perbandinganPixel.php?image1='.$image1.'&image2='.$image2. '&analisis1='.$analisis1. '&analisis2='.$analisis2.'"> Check Similarity </a></td>'; 
                echo '<td> <a href="/python?parent_id='. $_SESSION['parent_id'] .'&path1='.$row2['original_image'].'&path2='.$image1.'&path3='.$image2. '&analisis1='.$analisis1. '&analisis2='.$analisis2.'"> Check Similarity </a></td>'; 
            } 
            
            echo '</tr>';

    

    }

}
?>

</tbody>
</table>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/via.js"></script>
    <script src="../js/anotasi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>