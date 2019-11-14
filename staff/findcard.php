<?php
include("../config29.php");
if(!isset($_GET['empId']) || !isset($_GET['card_type']))
{    
    die();
}
else 
{
    $empn = $_GET['empId']; 
    $type = $_GET['card_type'];
    $sqlCard = "SELECT * FROM car_card WHERE emp_id = '$empn' AND card_type_id=$type";
       
    $qCard = mysqli_query($conn, $sqlCard);
    
    $output = mysqli_num_rows($qCard);
            
    echo $output;    
}
?>