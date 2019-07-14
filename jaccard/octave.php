<?php 
$output = passthru('./jaccardp.py 2>&1');
var_dump($output);
?>