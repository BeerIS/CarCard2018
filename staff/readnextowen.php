<?php
session_start();
include("../config29.php"); 

$sql="SELECT MAX(owen_id) FROM nonemp_owen ";
$qOwen = mysqli_query($conn, $sql);
if(!$qOwen)
    die();

$owen=  mysqli_fetch_array($qOwen);

$nextOwenId = str_pad($owen[0]+1,4,"0",STR_PAD_LEFT);

echo $nextOwenId;
?>
