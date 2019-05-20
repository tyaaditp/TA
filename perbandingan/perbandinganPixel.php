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
        margin:0 !important;
	    padding-top: 0px !important;
        padding-bottom: 0px !important;
        padding-right: 10px;
        padding-left: 10px;
    }
    .hasil{
        width: 25%;
    }
    p{
        text-align: center;
    }
    h3{
        text-align: center;
    }
    </style>

</head>

<body>

<!-- navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <img src="minilogo.png" alt="minilogo optan" class="mr-2" href="index.php" style="width:5em;">

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
      <h3 style="font-family:sans-serif; color: #efb523;">Similarity Result</h3>
    </ul>
    <form action="" class="form-inline my-2 my-lg-0">
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" style="color:beige;"><?php echo $_SESSION['username'] ?> as <?php echo $_SESSION['role'] ?></a>
        <!-- <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="" style="color:beige;"><?php echo $_SESSION['role'] ?></a> -->
        <!-- <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="index.php" style="color:beige;">Home</a> -->
        <a class="d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="logout.php" style="color:beige;"><button type="button" class="btn btn-outline-secondary btn-sm">Logout</button></a>
    </form>
  </div>
</nav>

<!-- end of navbar -->

<?php
session_start();
// echo "<h3> Similarity Result </h3>";

// Direktori gambar
 $gambar = dirname(__DIR__);

 $argv1 = $gambar . $_GET['image1'];
 $argv2 = $gambar . $_GET['image2'];
 $argv3 = $gambar .  '/uploads/hasil';
 
// Gambar masuk
$i1 = @imagecreatefromstring(file_get_contents($argv1));
$i2 = @imagecreatefromstring(file_get_contents($argv2));

// cek gambar
if (!$i1) {
    echo $argv1 . ' is not a valid image';
    exit(1);
}
if (!$i2) {
    echo $argv2 . ' is not a valid image';
    exit(1);
}
 
// cari dimensi gambar
$sx1 = imagesx($i1);
$sy1 = imagesy($i1);
 
// // compare dimensi
// if ($sx1 !== imagesx($i2) || $sy1 !== imagesy($i2)) {
//     echo "Similarity are not valid because The images are not the same size";
//     // sexit(1);
// }
 
// create a diff image (gambar perbedaan)
$diffi = imagecreatetruecolor($sx1, $sy1);
$green = imagecolorallocate($diffi, 0, 255, 0);
imagefill($diffi, 0, 0, imagecolorallocate($diffi, 0, 0, 0));
 
// increment this counter when encountering a pixel diff
$different_pixels = 0;
 
// loop x and y
for ($x = 0; $x < $sx1; $x++) {
    for ($y = 0; $y < $sy1; $y++) {
 
        $rgb1 = imagecolorat($i1, $x, $y); // cari detailnya
        $pix1 = imagecolorsforindex($i1, $rgb1); //cari detailnya 
 
        $rgb2 = imagecolorat($i2, $x, $y);
        $pix2 = imagecolorsforindex($i2, $rgb2);
 
        $rentang = 100;
        if (($pix2['red'] >= $pix1['red']+$rentang || $pix2['red']  <= $pix1['red']-$rentang) 
        || ($pix2['green'] >= $pix1['green']+$rentang || $pix2['green']  <= $pix1['green']-$rentang)
        || ($pix2['blue'] >= $pix1['blue']+$rentang || $pix2['blue']  <= $pix1['blue']-$rentang)) {
            // increment and paint in the diff image
            $different_pixels++;
            imagesetpixel($diffi, $x, $y, $green);
        }
 
    }
}
 
 $similari = 0;
if (!$different_pixels) {
    $similari= 100;
} else {
    if (empty($argv3)) {
        $argv3 = 'diffy.jpg'; // default result filename
    }
    imagejpeg($diffi, $argv3);
    $total = $sx1 * $sy1;
    // echo "<h3 style="text-align:center; font-family: sans-serif;"> Result </h3>";
    $sim = $different_pixels / $total;
    $similari = number_format(100-(100 * $sim), 2);
    // echo "<p style="text-align: center;"><textarea rows="3" style="width:25%;"> '.$different_pixels/$total.' same pixels, or '.number_format(100-(100 * $different_pixels / $total), 2).' % </textarea></p>" ;
    // echo "<p style="text-align: center;"><textarea rows="3" style="width:25%;"> '.$sim.' same pixels, or <b> '.$similari.' % </b></textarea></p>";
    
}
// compare dimensi
if ($sx1 !== imagesx($i2) || $sy1 !== imagesy($i2)) {
    echo "<p><textarea class=\"hasil\">Similarity are not valid because The images are not the same size </textarea></p>";
    echo "<br>";
    echo "<br>";
    // sexit(1);
}else{
echo "<p><textarea class=\"hasil\">       $similari %</textarea></p>";
    echo "<br>";
    echo "<br>";
}
// menampilkan hasil
?>
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
        <td> Image anotated reference </td>
        <td> Image anotated </td>
    </tr>
</thead>
<tbody>
    <tr>
        <td> <img widht=40 src='<?php echo  $_GET['image1'] ?>' ></td>
        <td> <img widht=40 src='<?php echo  $_GET['image2'] ?>' ></td>
        <!-- <td> <img widht=40 src='<?php echo  "/uploads/" . basename($argv3) ?>' ></td> -->
    </tr>
    <tr>
        <td> <?php echo $_GET['analisis1'] ?> </td>
        <td> <?php echo $_GET['analisis2'] ?> </td>
    </tr>

</tbody>
</table> 


    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/via.js"></script>
    <script src="../js/anotasi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>