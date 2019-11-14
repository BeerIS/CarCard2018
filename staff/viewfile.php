<?php

include("../connectSQL.php");
$req_id = $_GET['req_id'];
$req_car_id = $_GET['req_car_id'];
$doc = $_GET['doc'];

switch ($doc) {
    case 0: $sql = "SELECT car_license, car_license_filename FROM request_car WHERE request_id = '$req_id' AND request_car_id = $req_car_id";
        break;
    case 1: $sql = "SELECT house_registration, house_registration_filename FROM request_car WHERE request_id = '$req_id' AND request_car_id = $req_car_id";
        break;
    case 2: $sql = "SELECT marriage_license, marriage_license_filename FROM request_car WHERE request_id = '$req_id' AND request_car_id = $req_car_id";
        break;
}
$qFile = mysqli_query($objConnect, $sql);
$file = mysqli_fetch_array($qFile);

header("Content-Type: application/pdf");
echo $file[0];
?>  

