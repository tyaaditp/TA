<?php

// Direktori gambar
 $gambar = dirname(__DIR__);

 $argv1 = $gambar . '/uploads/original.jpg';
 $argv2 = $gambar . '/uploads/o75.jpg';
 
// Gambar masuk
$i1 = @imagecreatefromstring(file_get_contents($argv1));
$i2 = @imagecreatefromstring(file_get_contents($argv2));
 
// cari dimensi gambar
$sx1 = imagesx($i1);
$sy1 = imagesy($i1);
 
// compare dimensi
if ($sx1 !== imagesx($i2) || $sy1 !== imagesy($i2)) {
    echo "The images are not even the same size";
    exit(1);
}
// nilai awal
$different_pixels = 0;
 
// loop x and y
for ($x = 0; $x < $sx1; $x++) {
    for ($y = 0; $y < $sy1; $y++) {
 
        $rgb1 = imagecolorat($i1, $x, $y);
        $pix1 = imagecolorsforindex($i1, $rgb1);
 
        $rgb2 = imagecolorat($i2, $x, $y);
        $pix2 = imagecolorsforindex($i2, $rgb2);
 
        $rentang = 40;
        if (($pix2['red'] >= $pix1['red']+$rentang || $pix2['red']  <= $pix1['red']-$rentang) 
        || ($pix2['green'] >= $pix1['green']+$rentang || $pix2['green']  <= $pix1['green']-$rentang)
        || ($pix2['blue'] >= $pix1['blue']+$rentang || $pix2['blue']  <= $pix1['blue']-$rentang)) { // different pixel (dibuat range jangan sama persis)
            // increment and paint in the diff image
            $different_pixels++;
        }
 
    }
}
// menampilkan hasil
$total = $sx1 * $sy1;
echo "different pixel : $different_pixels/$total Presentase persamaan :", number_format(100-(100 * $different_pixels / $total), 2), '%';
?>

