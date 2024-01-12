<?php
$f =$_GET["f"];
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$f\"\n");
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0"); 
    header("Pragma: public");
    $fp=fopen("$f", "r");
    fpassthru($fp);
?>