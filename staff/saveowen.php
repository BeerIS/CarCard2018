<?php
session_start();
include("../config29.php"); 

if(!isset($_POST['txtOwenId'])||!isset($_POST['txtOwenPrefix'])||!isset($_POST['txtOwenName'])||!isset($_POST['txtOwenAdd'])||!isset($_POST['txtOwenTel1'])||!isset($_POST['hdnOwenType'])||!isset($_POST['hdnMode']))
{
    echo "55555";
    die();
}

$owenId=$_POST['txtOwenId'];
$owenPrefix=$_POST['txtOwenPrefix'];
$owenName=$_POST['txtOwenName'];
$owenAdd=$_POST['txtOwenAdd'];
$owenTel1=$_POST['txtOwenTel1'];
$owenTel2=$_POST['txtOwenTel2'];
$owenType=$_POST['hdnOwenType'];
$mode=$_POST['hdnMode'];

$sqlowen="aaa";
if($mode=="edit")
{
    $sqlOwen = "UPDATE nonemp_owen "
            . " SET owen_prefix = '$owenPrefix',"
            . " owen_name = '$owenName',"
            . " owen_add = '$owenAdd',"
            . " tel1 = '$owenTel1',"
            . " tel2 = '$owenTel2'"
            . " WHERE owen_id = '$owenId'";
}
else if($mode=="add")
{
    $sqlOwen="INSERT INTO nonemp_owen "
            . " (owen_id,otype_id,owen_prefix, owen_name, owen_add, tel1, tel2)"
            . " VALUES ("
                . "'$owenId', $owenType, '$owenPrefix', '$owenName', '$owenAdd', '$owenTel1', '$owenTel2'"
            . ")";
}

$qowen = mysqli_query($conn, $sqlOwen);
if(!$qowen)
    echo 0;
else
    echo 1;
?>
