<?php
$e = escapeshellcmd('python /Users/adityapratama/jaccard/jaccardp.py');
$output = shell_exec($e);
var_dump($output);
?>