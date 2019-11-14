<?php
session_start();
include("../config29.php"); 
if(!isset($_POST['tel1'])||!isset($_POST['tel2'])||!isset($_POST['empId']))
{
    die();
}
$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$empId=$_POST['empId'];
$sqlTel = "UPDATE nonemp_owen SET tel1 = '$tel1', tel2='$tel2' WHERE owen_id='$empId'";
echo $sqlTel;

$qTel= mysqli_query($conn, $sqlTel);
if(!$qTel)
{
    echo 0;
    die();
}
echo 1;
?>
