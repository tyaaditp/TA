<?php
function compareImages($imagePathA, $imagePathB, $accuracy){
  //load base image
  $bim = imagecreatefromjpeg($imagePathA);
  //create comparison points
  $bimX = imagesx($bim);
  $bimY = imagesy($bim);
  $pointsX = $accuracy*5;
  $pointsY = $accuracy*5;
  $sizeX = round($bimX/$pointsX);
  $sizeY = round($bimY/$pointsY);
  
  //load image into an object
  $im = imagecreatefromjpeg($imagePathB);
  
  
  //loop through each point and compare the color of that point
  $y = 0;
  $matchcount = 0;
  $num = 0;
  for ($i=0; $i <= $pointsY; $i++) { 
    $x = 0;
    for($n=0; $n <= $pointsX; $n++){
  
      $rgba = imagecolorat($bim, $x, $y);
      $colorsa = imagecolorsforindex($bim, $rgba);
  
      $rgbb = imagecolorat($im, $x, $y);
      $colorsb = imagecolorsforindex($im, $rgbb);
  
      if(colorComp($colorsa['red'], $colorsb['red']) && colorComp($colorsa['green'], $colorsb['green']) && colorComp($colorsa['blue'], $colorsb['blue'])){
        //point matches
        $matchcount ++;
      }
      $x += $sizeX;
      $num++;
    }
    $y += $sizeY;
  }
  //take a rating of the similarity between the points, if over 90 percent they match.
  $rating = $matchcount*(100/$num);
  return $rating;
}
function colorComp($color, $c){
	//test to see if the point matches - within boundaries
  if($color >= $c-2 && $color <= $c+2){
    return true;
  }else{
    return false;
  }
}