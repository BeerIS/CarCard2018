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

$sqlEmpTel = "SELECT * FROM owen_tel WHERE emp_id='$empId'";
$qEmpTel = mysqli_query($conn, $sqlEmpTel);
if(mysqli_num_rows($qEmpTel)==0)
{
  $sqlTel = "INSERT INTO owen_tel (emp_id, tel_1, tel_2) VALUES ('$empId','$tel1', '$tel2')";
}
else
{
  $sqlTel = "UPDATE owen_tel SET tel_1 = '$tel1', tel_2='$tel2' WHERE emp_id='$empId'";
}
$qTel= mysqli_query($conn, $sqlTel);

if(!$qTel)
{
    echo 0;
    die();
}
echo 1;
?>
