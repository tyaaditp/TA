<?php
/**
 * Shell script to tell if two images are identical.
 * If not, a third image is written - black background with the different pixels painted green
 * Code partially inspired by and borrowed from http://pear.php.net/Image_Text test cases
 */

 $gambar = __DIR__ . '/../';
 echo $gambar;

 $argv1 = $gambar . '/uploads/ori-awdawd-574';
 $argv2 = $gambar . '/uploads/ori-awdawd-650';
 
// create images
$i1 = @imagecreatefromstring(file_get_contents($argv1));
$i2 = @imagecreatefromstring(file_get_contents($argv2));
 
// check if we were given garbage
if (!$i1) {
    echo $argv1 . ' is not a valid image';
    exit(1);
}
if (!$i2) {
    echo $argv2 . ' is not a valid image';
    exit(1);
}
 
// dimensions of the first image
$sx1 = imagesx($i1);
$sy1 = imagesy($i1);
 
// compare dimensions
if ($sx1 !== imagesx($i2) || $sy1 !== imagesy($i2)) {
    echo "The images are not even the same size";
    exit(1);
}
 
// create a diff image
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
 
        if ($pix1 !== $pix2) { // different pixel
            // increment and paint in the diff image
            $different_pixels++;
            imagesetpixel($diffi, $x, $y, $green);
        }
 
    }
}
 
 
if (!$different_pixels) {
    echo "100%";
    exit(0);
} else {
    if (empty($argv3)) {
        $argv3 = 'diffy.jpg'; // default result filename
    }
    imagejpeg($diffi, $argv3);
    $total = $sx1 * $sy1;
    echo "$different_pixels/$total different pixels, or ", number_format(100 * $different_pixels / $total, 2), '%';
    exit(1);
}
?>