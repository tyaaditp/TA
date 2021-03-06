<?php

// Direktori gambar
 $gambar = dirname(__DIR__);

 $argv1 = $gambar . '/uploads/ori.jpg';
 $argv2 = $gambar . '/uploads/ori1.jpg';
 $argv3 = $gambar .  '/uploads/hasil3';
 
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
$green = imagecolorallocate($diffi, 0, 255, 0);
imagefill($diffi, 0, 0, imagecolorallocate($diffi, 0, 0, 0));
 
// increment this counter when encountering a pixel diff
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
            imagesetpixel($diffi, $x, $y, $green);
        }
 
    }
}
 foreach ($pix1 as $item) {
    echo $item;
}

echo join(', ', $pix1);

array_walk($pix1, create_function('$a', 'echo $a;'));

 
if (!$different_pixels) {
    echo "100%";
} else {
    if (empty($argv3)) {
        $argv3 = 'diffy.jpg'; // default result filename
    }
    echo ($argv3);
    imagejpeg($diffi, $argv3);
    $total = $sx1 * $sy1;
    echo "same pixels : $different_pixels/$total same pixels :", number_format(100-(100 * $different_pixels / $total), 2), '%';
}
// menampilkan hasil

?>

<img style='max-height:100%; max-width:100%' src='<?php echo "/uploads/" . basename($argv3) ?>'>
