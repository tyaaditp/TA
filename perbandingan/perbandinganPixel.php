<style>
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
<?php
session_start();
echo "<h3> Similarity Result </h3>";

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
<?php
    if(($_SESSION['role']) == 'Expert' ) {
        echo '<a href="/trialz.php"><p style="text-align: center;"><button style="background-color:#050300; color:#e8c033; font-family:sans-serif;">Back to annotation page</button></p></a> ';
    }
    else {
        echo '<a href="/trialzUser.php"><p style="text-align: center;"><button style="background-color:#050300; color:#e8c033; font-family:sans-serif;">Back to annotation page</button></p></a>';
    }
?>

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