<?php
    session_start();
    $car_id=$_GET['car_id'];
include("../config29.php");

$sql="DELETE FROM car WHERE id=$car_id";

$qDelete = mysqli_query($conn, $sql);

if($qDelete)
{
    echo "ลบข้อมูลสำเร็จ";
}
else
{
    echo "เกิดความผิดพลาดในการลบข้อมูล โปรดลองใหม่อีกครั้ง";
}
?>

