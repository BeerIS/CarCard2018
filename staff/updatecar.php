<?php
    session_start();
    $mode=$_POST['mode'];
    $cardId = $_POST['hdnCardId'];
    $carId = $_POST['hdnCarId'];
    $carRegis=$_POST['txtCarRegis'];
    $province=$_POST['ddlProvince'];
    $brand=$_POST['ddlBrand'];
    $ctype=$_POST['ddlType'];
    $color=$_POST['txtColor'];
include("../config29.php"); 
if($mode=="edit")
{
    $sql="UPDATE car SET "
            . "car_regis_number = '$carRegis', "
            . "brand_id = $brand,"
            . "pro_id = $province, "
            . "ctype_id = $ctype, "
            . "color = '$color'"
            . " WHERE id=$carId";
}
else if($mode=="new")
{
    $sql = "INSERT INTO car VALUES ("
            . "'', '$carRegis', 1, $brand, $province, $ctype, '$color', $cardId, 1"
            . ")";
}

$qCar = mysqli_query($conn, $sql);



if($qCar)
{
    echo "บันทึกข้อมูลสำเร็จ";
}
else
{
    echo "เกิดความผิดพลาดในการบันทึกข้อมูล โปรดลองใหม่อีกครั้ง";
}
?>
