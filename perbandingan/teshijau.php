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

// Direktori gambar
 $gambar = dirname(__DIR__);
 echo $gambar;

 $argv1 = $gambar . $_GET['image1'];
 $argv2 = $gambar . $_GET['image2'];
 $argv3 = $gambar .  '/uploads/hasil';
 $argv4 = $gambar .  '/uploads/hasil2';
 $argv5 = $gambar .  '/uploads/hasil3';
 
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
 
// compare dimensi
if ($sx1 !== imagesx($i2) || $sy1 !== imagesy($i2)) {
    echo "The images are not even the same size";
    exit(1);
}
 
// create a diff image (gambar perbedaan)
$diffi = imagecreatetruecolor($sx1, $sy1);
$diffi2 = imagecreatetruecolor($sx1, $sy1);
$diffi3 = imagecreatetruecolor($sx1, $sy1);
$green = imagecolorallocate($diffi, 0, 255, 0);
imagefill($diffi, 0, 0, imagecolorallocate($diffi, 0, 0, 0));
imagefill($diffi2, 0, 0, imagecolorallocate($diffi2, 0, 0, 0));
imagefill($diffi3, 0, 0, imagecolorallocate($diffi3, 0, 0, 0));
 
// increment this counter when encountering a pixel diff
$different_pixels = 0;
 
// loop x and y
for ($x = 0; $x < $sx1; $x++) {
    for ($y = 0; $y < $sy1; $y++) {
 
        $rgb1 = imagecolorat($i1, $x, $y); // cari detailnya
        $pix1 = imagecolorsforindex($i1, $rgb1); //cari detailnya 
 
        $rgb2 = imagecolorat($i2, $x, $y);
        $pix2 = imagecolorsforindex($i2, $rgb2);
    
        // $rentang = 20;
        // if (($pix2['red'] >= $pix1['red']+$rentang || $pix2['red']  <= $pix1['red']-$rentang) 
        // && ($pix2['green'] >= $pix1['green']+30 || $pix2['green']  <= $pix1['green']-30)
        // && ($pix2['blue'] >= $pix1['blue']+$rentang || $pix2['blue']  <= $pix1['blue']-$rentang)) {
        // if ($pix1['red'] <= $pix2['red']+20 || $pix1['red'] >= $pix2['red']-20 ) { // different pixel

        if (($pix2['green'] >= 150) && ($pix2['blue']<=50)) {
            // increment and paint in the diff image
            //$different_pixels++;
            //echo $x.$y;
            imagesetpixel($diffi, $x, $y, $green);
            
        }
        if (($pix1['green'] >= 150) && ($pix1['blue']<=50)) {
            // increment and paint in the diff image
            //$different_pixels++;
            //echo $x.$y;
            imagesetpixel($diffi2, $x, $y, $green);
        }
    }
}
 
 
// if (!$different_pixels) {
// //     echo "100%";
// // } else {
//     if (empty($argv3)) {
//         $argv3 = 'diffy.jpg'; // default result filename
//     }
//     echo ($argv3);

    imagejpeg($diffi, $argv3);
    imagejpeg($diffi2, $argv4);
    $i3 = @imagecreatefromstring(file_get_contents($argv3));
    $i4 = @imagecreatefromstring(file_get_contents($argv4));
    
    for ($x = 0; $x < $sx1; $x++) {
        for ($y = 0; $y < $sy1; $y++) {
     
            $rgb1 = imagecolorat($i3, $x, $y); // cari detailnya
            $pix1 = imagecolorsforindex($i3, $rgb1); //cari detailnya 
     
            $rgb2 = imagecolorat($i4, $x, $y);
            $pix2 = imagecolorsforindex($i4, $rgb2);
        
            //if ($pix1 !== $pix2) { // different pixel (dibuat range jangan sama persis)
                $rentang = 6;
        if (($pix2['red'] >= $pix1['red']+$rentang || $pix2['red']  <= $pix1['red']-$rentang) 
        && ($pix2['green'] >= $pix1['green']+30 || $pix2['green']  <= $pix1['green']-30)
        && ($pix2['blue'] >= $pix1['blue']+$rentang || $pix2['blue']  <= $pix1['blue']-$rentang)) {
                // increment and paint in the diff image
                $different_pixels++;
                imagesetpixel($diffi3, $x, $y, $green);
            }
        }
    }

    imagejpeg($diffi3, $argv5);
    $total = $sx1 * $sy1;
    // echo "<h3 style="text-align:center; font-family: sans-serif;"> Result </h3>";
    echo "<h3> Result </h3>";
    $sim = $different_pixels / $total;
    $similari = number_format(100-(100 * $sim), 2);
    // echo "<p style="text-align: center;"><textarea rows="3" style="width:25%;"> '.$different_pixels/$total.' same pixels, or '.number_format(100-(100 * $different_pixels / $total), 2).' % </textarea></p>" ;
    // echo "<p style="text-align: center;"><textarea rows="3" style="width:25%;"> '.$sim.' same pixels, or <b> '.$similari.' % </b></textarea></p>";
    echo "<p><textarea class=\"hasil\"> '.$different_pixels.' diff pixels, or '.$similari.' %</textarea></p>";
    echo "<br>";
    echo "<br>";
// }
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
<img widht=40 src='<?php echo "/TA" . $_GET['image1'] ?>' ><br>
<img widht=40 src='<?php echo "/TA" . $_GET['image2'] ?>' ><br>
<img style='max-height:100%; max-width:100%' src='<?php echo "/uploads/" . basename($argv3) ?>'>
<img style='max-height:100%; max-width:100%' src='<?php echo "/uploads/" . basename($argv4) ?>'>
<img style='max-height:100%; max-width:100%' src='<?php echo "/uploads/" . basename($argv5) ?>'>