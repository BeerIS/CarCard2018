<?php
include("config29.php");

$sql="SELECT * FROM car_card_regis.car_card";

$qCarCard = mysqli_query($conn, $sql);

$result = mysqli_fetch_array($qCarCard);

print_r($result);

?>