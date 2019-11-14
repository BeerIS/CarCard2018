<?php
session_start();
include("../config29.php"); 

if(!isset($_GET['owenId']))
{
    echo "55555";
    die();
}

$owenId=$_GET['owenId'];
$sqlOwen = "DELETE FROM nonemp_owen WHERE owen_id='$owenId'";

$qowen = mysqli_query($conn, $sqlOwen);
if(!$qowen)
    echo 0;
else
    echo 1;
?>
