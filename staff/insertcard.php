<?php
session_start();
include("../connectSQL.php");
/*if(!(isset($_POST['empId'])||isset($_POST['owenId']))||!isset($_POST['card_type'])||!isset($_POST['cars'])||!isset($_POST['remark']))
{
    die();
}*/
if($_POST['card_type']==1||$_POST['card_type']==2)
{
    $empId = $_POST['empId'];
    $cardType=$_POST['card_type'];
    $cars=$_POST['cars'];
    $remark=$_POST['remark'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $username = $_SESSION['username'];

    $sqlTel = "SELECT * FROM owen_tel WHERE emp_id='$empId'";
    $qTel = mysqli_query($objConnect, $sqlTel);
    if(mysqli_num_rows($qTel)>0)
    {
        $sqlTel = "UPDATE owen_tel SET tel_1 = '$tel1', tel_2='$tel2' WHERE emp_id='$empId'";
    }
    else
    {
        $sqlTel = "INSERT INTO owen_tel VALUES('','$empId', '$tel1','$tel2')";
    }
    $qTel= mysqli_query($objConnect, $sqlTel);
    if(!$qTel)
    {
        echo 0;
        die();
    }

    $sqlCard = "INSERT INTO car_card VALUES ('',now(),'2019-12-31','$remark','$empId',$username,$cardType)";
    $qCard= mysqli_query($objConnect, $sqlCard);
    if(!$qCard)
    {
        echo 0;
        die();
    }
    $cardNo = mysqli_insert_id($objConnect);
    foreach($cars as $car)
    {
        $sqlCar = "INSERT INTO car VALUES ('','$car[carRegis]',1,'$car[brandId]','$car[provinceId]','$car[typeId]','$car[color]',$cardNo, 1)";
        $qCar=  mysqli_query($objConnect, $sqlCar) or die("Error on inserting cars");
        if(!$qCard)
        {
            echo 0;
            die();
        }
    }
    echo $cardNo;
}
else if($_POST['card_type']==3||$_POST['card_type']==4)
{
    $empId = $_POST['empId'];
    $cardType=$_POST['card_type'];
    $cars=$_POST['cars'];
    $remark=$_POST['remark'];
    $username = $_SESSION['username'];
    $sqlCard = "INSERT INTO car_card VALUES ('',now(),'2019-12-31','$remark','$empId',$username,$cardType)";

    $qCard= mysqli_query($objConnect, $sqlCard);
    if(!$qCard)
    {
        echo 0;
        die();
    }
    $cardNo = mysqli_insert_id($objConnect);
    foreach($cars as $car)
    {
        $sqlCar = "INSERT INTO car VALUES ('','$car[carRegis]',1,'$car[brandId]','$car[provinceId]','$car[typeId]','$car[color]',$cardNo,1)";
        //echo $sqlCar;
        $qCar=  mysqli_query($objConnect, $sqlCar) or die("Error on inserting cars");
        if(!$qCard)
        {
            echo 0;
            die();
        }
    }
    echo $cardNo;
}
?>
